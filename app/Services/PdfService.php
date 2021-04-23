<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfService {

    public function __construct(UserRepository $userRepo)
    {
        $this->repository = $userRepo;
    }

    public function pdfReport($pdf)
    {
        $filePath = $this->fileNaming('\pdf');

        Storage::put($filePath, $pdf->output());

        // return Storage::url($filePath);
        return $pdf->download('report.pdf');
    }

    private function fileNaming($folder)
    {
        $fileName   = time() . '.' . 'pdf';
        $randomString = Str::random(15);
        $filePath = $folder . '/'. $randomString . $fileName;
        return $filePath;
    }

}