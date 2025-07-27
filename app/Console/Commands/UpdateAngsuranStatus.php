<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Angsuran;
use Illuminate\Console\Command;

class UpdateAngsuranStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'angsuran:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status angsuran menjadi "Terlambat" jika melewati tanggal jatuh tempo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Ambil semua angsuran yang belum dibayar dan melewati tanggal jatuh tempo
        $angsuranTerlambat = Angsuran::where('status', 'Belum Bayar')
            ->where('tgl_jatuh_tempo', '<', $today)
            ->get();

        foreach ($angsuranTerlambat as $angsuran) {
            $angsuran->update([
                'status' => 'Terlambat',
            ]);
        }

        $this->info('Status angsuran yang melewati tanggal jatuh tempo telah diperbarui.');
    }
}
