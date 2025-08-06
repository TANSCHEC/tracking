<?php
require_once('tcpdf/tcpdf.php');
include 'config.php';

// Fetch all records
$query = "SELECT * FROM document_logs ORDER BY scanned_at DESC";
$result = $conn->query($query);

// Initialize TCPDF
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator('TANSCHE');
$pdf->SetAuthor('TANSCHE');
$pdf->SetTitle('Document Logs Report');
$pdf->SetHeaderData('', 0, '📄 Document Logs Report', 'Generated on: ' . date('d-m-Y'));

$pdf->setHeaderFont(array('helvetica', '', 10));
$pdf->setFooterFont(array('helvetica', '', 8));
$pdf->SetDefaultMonospacedFont('courier');

$pdf->SetMargins(10, 20, 10);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 12);

$pdf->AddPage();

// Table Header
$html = '
<style>
  th { background-color: #f2f2f2; font-weight: bold; }
  td, th { font-size: 9pt; }
</style>
<table border="1" cellpadding="4">
  <thead>
    <tr>
      <th width="30">ID</th>
      <th width="70">DR.NO</th>
      <th width="60">Section</th>
      <th width="70">Action</th>
      <th width="40">Period</th>
      <th width="80">Petitioner</th>
      <th width="60">Degree</th>
      <th width="60">University</th>
      <th width="60">Board</th>
      <th width="50">Status</th>
      <th width="60">Letter Date</th>
      <th width="70">GO No</th>
      <th width="60">GO Date</th>
      <th width="70">Date Scanned</th>
    </tr>
  </thead>
  <tbody>
';

// Table Rows
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['dr_no'] . '</td>
            <td>' . $row['section'] . '</td>
            <td>' . $row['action_taken'] . '</td>
            <td>' . $row['action_period'] . '</td>
            <td>' . $row['petitioner'] . '</td>
            <td>' . $row['degree'] . '</td>
            <td>' . $row['university_equivalent'] . '</td>
            <td>' . $row['board'] . '</td>
            <td>' . $row['status'] . '</td>
            <td>' . $row['letter_date'] . '</td>
            <td>' . $row['go_no'] . '</td>
            <td>' . $row['go_date'] . '</td>
            <td>' . $row['scanned_at'] . '</td>
        </tr>';
  }
} else {
  $html .= '<tr><td colspan="14" align="center">No data available</td></tr>';
}

$html .= '</tbody></table>';

// Output PDF
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('document_logs_report.pdf', 'I');
