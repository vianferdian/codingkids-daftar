<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * Build report query based on request filters.
     */
    protected function getFilteredQuery(Request $request)
    {
        $query = Registration::query();

        if ($category = $request->input('category')) {
            if (in_array(strtolower($category), ['sd', 'smp'])) {
                $query->where('category', strtolower($category));
            }
        }

        if ($school = trim((string) $request->input('school'))) {
            $query->where('school', $school);
        }

        if ($startDate = $request->input('start_date')) {
            $query->whereDate('registered_at', '>=', $startDate);
        }

        if ($endDate = $request->input('end_date')) {
            $query->whereDate('registered_at', '<=', $endDate);
        }

        return $query;
    }

    /**
     * Display the report page.
     */
    public function index(Request $request): View
    {
        $query = $this->getFilteredQuery($request);

        // Cloned queries for summary cards
        $totalPeserta = (clone $query)->count();
        $pesertaSd = (clone $query)->where('category', 'sd')->count();
        $pesertaSmp = (clone $query)->where('category', 'smp')->count();

        $registrations = $query->orderBy('registered_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        $schools = Registration::select('school')
            ->distinct()
            ->orderBy('school')
            ->pluck('school');

        return view('admin.reports.index', compact(
            'registrations',
            'schools',
            'totalPeserta',
            'pesertaSd',
            'pesertaSmp'
        ));
    }

    /**
     * Export report to Excel (.xlsx) using PhpSpreadsheet.
     */
    public function exportExcel(Request $request): StreamedResponse
    {
        $query = $this->getFilteredQuery($request);
        $registrations = $query->orderBy('registered_at', 'asc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Peserta CodingKids');

        // Main Title Header
        $sheet->setCellValue('A1', 'LAPORAN PENDAFTARAN PESERTA CODINGKIDS');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF4F46E5'));
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Subtitle / Filters info
        $filterInfo = 'Dicetak pada: ' . Carbon::now()->translatedFormat('d F Y H:i') . ' WIB';
        if ($request->input('category')) {
            $filterInfo .= ' | Kategori: ' . strtoupper($request->input('category'));
        }
        if ($request->input('school')) {
            $filterInfo .= ' | Sekolah: ' . $request->input('school');
        }
        if ($request->input('start_date') || $request->input('end_date')) {
            $filterInfo .= ' | Periode: ' . ($request->input('start_date') ?: 'Awal') . ' s/d ' . ($request->input('end_date') ?: 'Sekarang');
        }

        $sheet->setCellValue('A2', $filterInfo);
        $sheet->mergeCells('A2:H2');
        $sheet->getStyle('A2')->getFont()->setSize(10)->setItalic(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Summary Info row
        $sheet->setCellValue('A3', 'Total Data: ' . $registrations->count() . ' Peserta');
        $sheet->mergeCells('A3:H3');
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Table Headers
        $headers = [
            'A5' => 'NO',
            'B5' => 'NAMA LENGKAP',
            'C5' => 'TANGGAL LAHIR',
            'D5' => 'KATEGORI',
            'E5' => 'ASAL SEKOLAH',
            'F5' => 'NAMA ORANG TUA/WALI',
            'G5' => 'NOMOR HP',
            'H5' => 'ALAMAT LENGKAP',
            'I5' => 'TANGGAL DAFTAR',
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        $headerRange = 'A5:I5';
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFFFF'));
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF4F46E5');
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(5)->setRowHeight(28);

        // Table Rows
        $row = 6;
        $no = 1;
        foreach ($registrations as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item->full_name);
            $sheet->setCellValue('C' . $row, Carbon::parse($item->birth_date)->translatedFormat('d-m-Y'));
            $sheet->setCellValue('D' . $row, strtoupper($item->category));
            $sheet->setCellValue('E' . $row, $item->school);
            $sheet->setCellValue('F' . $row, $item->parent_name);
            $sheet->setCellValueExplicit('G' . $row, $item->parent_phone, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('H' . $row, $item->address);
            $sheet->setCellValue('I' . $row, Carbon::parse($item->registered_at)->translatedFormat('d-m-Y H:i'));

            // Alternating row background
            if ($row % 2 === 0) {
                $sheet->getStyle("A{$row}:I{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFF8FAFC');
            }

            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("D{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("I{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $row++;
        }

        $lastRow = max(6, $row - 1);
        $tableRange = "A5:I{$lastRow}";

        // Borders
        $sheet->getStyle($tableRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFE2E8F0');

        // Auto-fit column widths
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'Laporan_Peserta_CodingKids_' . date('Ymd_His') . '.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Export report to CSV with UTF-8 BOM.
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $query = $this->getFilteredQuery($request);
        $registrations = $query->orderBy('registered_at', 'asc')->get();

        $fileName = 'Laporan_Peserta_CodingKids_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($registrations) {
            $output = fopen('php://output', 'w');

            // UTF-8 BOM for Excel compatibility
            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header row
            fputcsv($output, [
                'No',
                'Nama Peserta',
                'Tanggal Lahir',
                'Kategori',
                'Asal Sekolah',
                'Nama Orang Tua/Wali',
                'Nomor HP',
                'Alamat Lengkap',
                'Tanggal Daftar'
            ]);

            $no = 1;
            foreach ($registrations as $item) {
                fputcsv($output, [
                    $no++,
                    $item->full_name,
                    Carbon::parse($item->birth_date)->format('Y-m-d'),
                    strtoupper($item->category),
                    $item->school,
                    $item->parent_name,
                    "'" . $item->parent_phone, // Prevent leading zero trim in Excel
                    $item->address,
                    Carbon::parse($item->registered_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($output);
        }, 200, $headers);
    }

    /**
     * Print report preview (A4 layout).
     */
    public function print(Request $request): View
    {
        $query = $this->getFilteredQuery($request);
        $registrations = $query->orderBy('registered_at', 'asc')->get();

        $totalPeserta = $registrations->count();
        $pesertaSd = $registrations->where('category', 'sd')->count();
        $pesertaSmp = $registrations->where('category', 'smp')->count();

        $filters = [
            'category' => $request->input('category'),
            'school' => $request->input('school'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ];

        return view('admin.reports.print', compact(
            'registrations',
            'totalPeserta',
            'pesertaSd',
            'pesertaSmp',
            'filters'
        ));
    }
}
