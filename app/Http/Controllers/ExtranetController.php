<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Auth;

class ExtranetController extends Controller
{
    private string $baseUrl;
    private string $token;

    public function __construct()
    {
        $this->baseUrl = config('services.bugansystem.url');
        $this->token   = config('services.bugansystem.token');
    }

    private function headers(): array
    {
        return [
            'X-Webhook-Token' => $this->token ,
            'Accept'          => 'application/json',
        ];
    }

    public function listar(Request $request)
    {
        try {
            $response = Http::withHeaders($this->headers())
                ->post($this->baseUrl.'/api/extranet.listar', [
                    'desde'     => $request->desde,
                    'hasta'     => $request->hasta,
                    'idusuario' => Auth::user()->id
                ]);

            if ($response->failed()) {
                Log::error('Error listar extranet', ['status' => $response->status()]);
                return response()->json(['success' => false, 'message' => 'Error al conectar.'], 500);
            }

            return response()->json($response->json());

        } catch (\Exception $e) {
            Log::error('Excepción listar: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error de conexión.'], 500);
        }
    }

    public function guardar(Request $request)
    {
        try {
            $response = Http::withHeaders($this->headers())
                ->post($this->baseUrl . '/api/v1/extranet.guardar', [
                    'servicios' => $request->servicios,
                    'idusuario' => Auth::user()->id,
                ]);

            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Error al guardar.'], 500);
            }

            return response()->json($response->json());

        } catch (\Exception $e) {
            Log::error('Excepción guardar: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error de conexión.'], 500);
        }
    }

    public function editar(Request $request)
    {
        try {
            $response = Http::withHeaders($this->headers())
                ->post($this->baseUrl . '/api/v1/extranet.editar', [
                    'idfacturaproveedor' => $request->idfacturaproveedor,
                    'tipodocumento'      => $request->tipodocumento,
                    'codigofactura'      => $request->codigofactura,
                    'monto'              => $request->monto,
                    'idusuario'          => Auth::user()->id,
                ]);

            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Error al editar.'], 500);
            }

            return response()->json($response->json());

        } catch (\Exception $e) {
            Log::error('Excepción editar: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error de conexión.'], 500);
        }
    }

    public function subirarchivo(Request $request)
    {
        $request->validate([
            'idfacturaproveedor' => 'required|integer',
            'file'               => 'required|file|mimes:pdf,xml,zip,rar,jpg,jpeg,png|max:10240',
        ]);

        try {
            $response = Http::withHeaders($this->headers())
                ->attach('file', file_get_contents($request->file('file')), $request->file('file')->getClientOriginalName())
                ->post($this->baseUrl . '/api/v1/extranet.subirarchivo', [
                    'idfacturaproveedor' => $request->idfacturaproveedor,
                    'idusuario'          => Auth::user()->id,
                ]);

            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Error al subir archivo.'], 500);
            }

            return response()->json($response->json());

        } catch (\Exception $e) {
            Log::error('Excepción subirarchivo: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error de conexión.'], 500);
        }
    }

    public function listararchivos($idfacturaproveedor)
    {
        try {
            $response = Http::withHeaders($this->headers())
                ->get($this->baseUrl . '/api/v1/extranet.listararchivos/' . $idfacturaproveedor, [
                    'idusuario' => Auth::user()->id,
                ]);

            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Error al listar archivos.'], 500);
            }

            return response()->json($response->json());

        } catch (\Exception $e) {
            Log::error('Excepción listararchivos: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error de conexión.'], 500);
        }
    }

    public function eliminararchivo($id)
    {
        try {
            $response = Http::withHeaders($this->headers())
                ->delete($this->baseUrl . '/api/v1/extranet.eliminararchivo/' . $id, [
                    'idusuario' => Auth::user()->id,
                ]);

            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Error al eliminar archivo.'], 500);
            }

            return response()->json($response->json());

        } catch (\Exception $e) {
            Log::error('Excepción eliminararchivo: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error de conexión.'], 500);
        }
    }

    public function subirpago(Request $request)
    {
        $request->validate([
            'idfacturaproveedor' => 'required|integer',
            'montopago'          => 'required|numeric|min:0',
            'fechapago'          => 'required|date',
            'observacion'        => 'nullable|string|max:255',
            'file'               => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        try {
            $response = Http::withHeaders($this->headers())
                ->attach('file', file_get_contents($request->file('file')), $request->file('file')->getClientOriginalName())
                ->post($this->baseUrl . '/api/v1/extranet.subirpago', [
                    'idfacturaproveedor' => $request->idfacturaproveedor,
                    'montopago'          => $request->montopago,
                    'fechapago'          => $request->fechapago,
                    'observacion'        => $request->observacion ?? '',
                    'idusuario'          => Auth::user()->id,
                ]);

            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Error al subir pago.'], 500);
            }

            return response()->json($response->json());

        } catch (\Exception $e) {
            Log::error('Excepción subirpago: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error de conexión.'], 500);
        }
    }

    public function eliminarpago(Request $request)
    {
        try {
            $response = Http::withHeaders($this->headers())
                ->post($this->baseUrl . '/api/v1/extranet.eliminarpago', [
                    'idfacturaproveedor' => $request->idfacturaproveedor,
                    'idusuario'          => Auth::user()->id,
                ]);

            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Error al eliminar pago.'], 500);
            }

            return response()->json($response->json());

        } catch (\Exception $e) {
            Log::error('Excepción eliminarpago: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error de conexión.'], 500);
        }
    }
}