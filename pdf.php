<?php
  require_once './lib/tcpdf.php';
  $tcpdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
  $tcpdf->AddPage();
  $tcpdf->SetFont('kozgopromedium', '', 10);

  $html = <<< EOF

  <h2>お買上げ明細</h2>
  <p>情報太郎様のお買上げ明細は次の通りです。</p>
  <ul>
    <li>メモリ: 5,000円</li>
    <li>HDD：9,000円</li>
    <li>合計：14,000円</li>
  </ul>
  EOF;
  $tcpdf->writeHTML($html);
  $tcpdf->Output('order_form.pdf', 'I');