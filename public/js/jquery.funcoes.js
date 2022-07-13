//Somente habilita o campo quando o perfil do usuario for colaborador
function disableTipoDeficienciaEAcompanhante(id) {

    $(".tipoDeficiencia").prop('disabled', true);

    if (id == 1) {
        $(".tipoDeficiencia").prop('disabled', false);
    }

    $(".chkAcompanhante").prop('disabled', true);
    if (id == 1 || id == 2) {
        $(".chkAcompanhante").prop('disabled', false);
    }
}

function disableAcompanhante(acompanhante) {
    $("#txtNomeAcompanhante").prop('disabled', true);
    $("#txtDocumentoAcompanhante").prop('disabled', true);
    $("#txtTelefoneAcompanhante").prop('disabled', true);
    $(".chkAcompanhanteMenor").prop('disabled', true);

    if (acompanhante == "S") {
        $("#txtNomeAcompanhante").prop('disabled', false);
        $("#txtDocumentoAcompanhante").prop('disabled', false);
        $("#txtTelefoneAcompanhante").prop('disabled', false);
        $(".chkAcompanhanteMenor").prop('disabled', false);
    }
}

function disableQuantidadeMenores(acompanhanteMenor) {
    $("#txtQuantidadeMenor").prop('disabled', true);

    if (acompanhanteMenor == "S") {
        $("#txtQuantidadeMenor").prop('disabled', false);
    }

}

function disableCadeiraRodas(servicos) {

    $("#cboCadeiraDerodas").prop('disabled', true);
    $("#fileTermoAdesao").prop('disabled', true);

    if (servicos == 4) {
        $("#cboCadeiraDerodas").prop('disabled', false);
        $("#fileTermoAdesao").prop('disabled', false);

    }

}

function disableGuardaVolumes(servicos) {

    $(".chkGuardaVolume").prop('disabled', true);

    if (servicos == 5) {
        $(".chkGuardaVolume").prop('disabled', false);
    }
}