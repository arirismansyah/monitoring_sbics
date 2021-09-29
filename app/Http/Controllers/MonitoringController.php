<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Monitoring;
use App\Models\Backup;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (session('username') != null) {
            $nama_kab = session()->get('nama_kab');

            $list_kab = Kabupaten::all();

            $list_nama_kab = [];
            $list_jumlah_petugas = [];
            $list_jumlah_petugas_backup = [];

            $list_data_all = [];

            foreach ($list_kab as $kabs) {
                $jumlah_petugas = Monitoring::where('kab', $kabs['kab'])->count();
                $jumlah_petugas_backup = Monitoring::where('kab', $kabs['kab'])->where('jml', '>', 0)->count();

                $data = [
                    'kode_wil' => strval($kabs['prov']) . strval($kabs['kab']),
                    'nama_kab' => $kabs['nmkab'],
                    'jumlah_petugas' => $jumlah_petugas,
                    'jumlah_petugas_backup' => $jumlah_petugas_backup,
                ];

                array_push($list_nama_kab, $kabs['nmkab']);
                array_push($list_jumlah_petugas, $jumlah_petugas);
                array_push($list_jumlah_petugas_backup, $jumlah_petugas_backup);
                array_push($list_data_all, $data);
            }

            $data_all_petugas = Monitoring::all();

            $list_all_jumlah_file_diupload = [];
            $list_all_nama_petugas = [];

            foreach ($data_all_petugas as $petugas) {
                array_push($list_all_jumlah_file_diupload, $petugas['jml']);
                array_push($list_all_nama_petugas, $petugas['nama']);
            }

            return view(
                'home',
                compact(
                    'nama_kab',
                    'list_kab',
                    'list_nama_kab',
                    'list_jumlah_petugas',
                    'list_jumlah_petugas_backup',
                    'list_data_all',
                    'list_all_nama_petugas',
                    'list_all_jumlah_file_diupload',
                    'data_all_petugas',
                )
            );
        } else {
            return redirect()->action([AuthController::class, 'index']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        if (session('username') != null) {
            $nama_kab = session()->get('nama_kab');

            $list_kab = Kabupaten::all();

            $data_backup = Monitoring::join('ics_list_backup', 'ics_list_backup.uname', '=', 'ics_webmon_backup.uname')->get();

            $data_all_petugas = Monitoring::all();


            return view(
                'download',
                compact(
                    'nama_kab',
                    'list_kab',
                    'data_backup',
                    'data_all_petugas',
                )
            );
        } else {
            return redirect()->action([AuthController::class, 'index']);
        }
    }


    /**
     * Get data petugas by kab/kota
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPetugasbykab(Request $request)
    {
        //
        $kode_kab = $request->input('kode_kab');

        if ($kode_kab == '1600' || $kode_kab == 1600) {
            $data = Monitoring::all();
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            $data = Monitoring::where('kab', $kode_kab)->get()->toArray();
            return response()->json(['status' => 'success', 'data' => $data]);
        }
    }

    /**
     * Get data petugas by kab/kota
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFile(Request $request)
    {
        //
        $kode_kab = $request->input('kode_kab');
        $username = $request->input('username');

        if ($kode_kab != null && $username != null) {
            # code...
            $data_backup = Monitoring::join('ics_list_backup', 'ics_list_backup.uname', '=', 'ics_webmon_backup.uname')
            ->where('ics_webmon_backup.kab', '=', $kode_kab)
            ->where('ics_list_backup.uname', '=', $username)->get();
            return response()->json(['status' => 'success', 'data' => $data_backup]);
        } elseif ($kode_kab != null){
            $data_backup = Monitoring::join('ics_list_backup', 'ics_list_backup.uname', '=', 'ics_webmon_backup.uname')
            ->where('ics_webmon_backup.kab', '=', $kode_kab)->get();
            return response()->json(['status' => 'success', 'data' => $data_backup]);
        } else {
            $data_backup = Monitoring::join('ics_list_backup', 'ics_list_backup.uname', '=', 'ics_webmon_backup.uname')
            ->where('uname', $username)->get();
            return response()->json(['status' => 'success', 'data' => $data_backup]);
        }
    }

}
