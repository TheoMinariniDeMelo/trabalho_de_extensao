<?php

use Core\Library\Session;

if (! function_exists('setValor')) {

    /**
     * setValor
     *
     * @param string $campo 
     * @param mixed $default 
     * @return mixed
     */
    function setValor($campo, $default = "")
    {
        if (isset($_POST[$campo])) {
            return $_POST[$campo];
        } else {
            return $default;
        }
    }
}

if (! function_exists('setMsgFilderError')) {
    /**
     * setMsgFilderError
     *
     * @param string $campo 
     * @return string
     */
    function setMsgFilderError($campo)
    {
        $cRet   = '';

        if (isset($_POST['formErrors'][$campo])) {
            $cRet .= '<div class="mt-2 text-danger">';
            $cRet .= $_POST['formErrors'][$campo];
            $cRet .= '</div>';
        }

        return $cRet;
    }
}

if (! function_exists('exibeAlerta')) {
    /**
     * exibeAlerta
     *
     * @return string
     */
    function exibeAlerta()
    {
        $msgSucesso = Session::getDestroy('msgSucesso');
        $msgError   = Session::getDestroy('msgError');
        $msgAlerta  = Session::getDestroy('msgAlerta');
        $mensagem   = '';
        $classAlert = '';

        if ($msgSucesso != "") {
            $mensagem   = $msgSucesso;
            $classAlert = 'success';
        } elseif ($msgError != "") {
            $mensagem   = $msgError;
            $classAlert = 'danger';
        } elseif ($msgAlerta != "") {
            $mensagem   = $msgAlerta;
            $classAlert = 'warning';
        }

        if ($mensagem == "") {
            return "";
        } else {
            return  '<div class="m-2 alert alert-' . $classAlert . ' alert-dismissible fade show" role="alert">
                        ' . $mensagem . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }
}

if (! function_exists('datatables')) {
    /**
     * datatables
     *
     * @param string $idTable 
     * @return string
     */
    function datatables($idTable)
    {
        return '
        <script src="' . baseUrl() . 'assets/DataTables/datatables.min.js"></script>
        <style>
            div.dataTables_filter {
                text-align: right !important;
            }
        </style>
        <script>
            $(document).ready(function() {
                $("#' . $idTable . '").DataTable({
                    language: {
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        }
                    }
                });
            });
        </script>';
    }
}

function getStatusDescricao($status)
{
    if ($status == 1) {
        return "Ativo";
    } elseif ($status == 2) {
        return "Inativo";
    } else {
        return "...";
    }
}

function textoVinculo($codigo)
{
    return match ($codigo) {
        '1', 1 => 'CLT',
        '2', 2 => 'Estágio',
        '3', 3 => 'Temporário',
        default => 'Não informado',
    };
}

function textoModalidade($codigo)
{
    return match ($codigo) {
        '1', 1 => 'Presencial',
        '2', 2 => 'Remoto',
        '3', 3 => 'Híbrido',
        default => 'Não informado',
    };
}

function formatarData($data)
{
    if (!$data || $data == '0000-00-00') {
        return 'Data inválida';
    }

    $timestamp = strtotime($data);
    if (!$timestamp) {
        return 'Data inválida';
    }

    return date('d/m/Y', $timestamp);
}

function formatarCPF($cpf)
{
    // Remove tudo que não for número
    $cpf = preg_replace('/\D/', '', $cpf);

    if (strlen($cpf) !== 11) {
        return $cpf; // Retorna como está se não tiver 11 dígitos
    }

    return substr($cpf, 0, 3) . '.' .
        substr($cpf, 3, 3) . '.' .
        substr($cpf, 6, 3) . '-' .
        substr($cpf, 9, 2);
}

function getTipoTelefone($status)
{
    if ($status == 1) {
        return "Residencial";
    } elseif ($status == 2) {
        return "Celular";
    } else {
        return "...";
    }
}
