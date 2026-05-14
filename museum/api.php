<?php
header('Content-Type: application/json');

// Mengambil data JSON yang dikirim oleh JavaScript
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Membersihkan ID dari karakter tak terlihat
$artefak_id = isset($data['id']) ? trim($data['id']) : '';

// Database Artefak Majapahit
$database_artefak = [
    'ARTEFAK_01' => [
        'nama' => 'Keris Majapahit',
        'ai_response' => 'Halo! Di depanmu adalah Keris Majapahit. Senjata ini bukan sekadar alat perang, tapi juga simbol status sosial pada masanya.',
        'image' => 'foto/Arca-Garuda.jpg' // Hanya nama file
    ],
    'ARTEFAK_02' => [
    'nama' => 'Artefak kepala Kambing',
    'image' => 'foto/goat.glb', // Cukup nama filenya saja
    'ai_response' => 'Halo! Di depanmu adalah tengkorak kepala kambing. Mau tahu lebih lanjut?'
],
    'ARTEFAK_03' => [
        'nama' => 'Prasasti Trowulan',
        'ai_response' => 'Luar biasa! Kamu telah menemukan Prasasti Trowulan. Benda ini menjadi saksi bisu tata kota kerajaan pada masa itu.',
        'image' => 'foto aing kmj bds.jpg' 
    ]
];

// Cek apakah ID artefak ada di database
if (array_key_exists($artefak_id, $database_artefak)) {
    echo json_encode([
        'status' => 'success',
        'data' => $database_artefak[$artefak_id]
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Artefak tidak dikenali',
        'debug_id_received' => $artefak_id 
    ]);
}
?>