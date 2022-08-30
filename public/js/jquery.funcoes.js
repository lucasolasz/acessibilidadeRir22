//Somente habilita o campo quando o perfil do usuario for colaborador
function disableTipoDeficiencia(id_condicao) {

    $("#divTipoDeficiencia").hide(200);

    if (id_condicao == 1) {
        $("#divTipoDeficiencia").show(200);
    }
}


function disableAcompanhante(id_condicao) {

    $("#divAcompanhante").hide(200);

    if (id_condicao == 1 || id_condicao == 2) {
        $("#divAcompanhante").show(200);
    }

}

function disableAcompanhanteItens(chk_acompanhante) {

    $("#divAcompanhanteItens").hide(200);

    if (chk_acompanhante == 'S') {
        $("#divAcompanhanteItens").show(200);
    }

}


function disableQuantidadeMenores(acompanhanteMenor) {

    $("#divQtmenores").hide(200);

    if (acompanhanteMenor == "S") {

        $("#divQtmenores").show(200);
    }

}

function disableCadeiraRodas(chk_servicos) {

    $("#divCadeiraRodas").hide(200);

    if (chk_servicos == 4) {
        $("#divCadeiraRodas").show(200);

    }

}

function disableGuardaVolumes(servicos) {

    $("#divGuardaVolumes").hide(200);

    if (chk_servicos == 5) {
        $("#divGuardaVolumes").show(200);

    }
}


function disableTipoDeficienciaFisica(chk_tipo_deficiencia) {

    $("#divTipoDeficienciaFisica").hide(200);

    if (chk_tipo_deficiencia == 1) {
        $("#divTipoDeficienciaFisica").show(200);

    }
}


function chkAcessoServico(id_condicao) {

    $('#chkAcessoServico3').prop('checked', false);
    $('#chkAcessoServico2').prop('checked', false);
    $('#chkAcessoServico1').prop('checked', false);


    if (id_condicao > 1) {

        $('#chkAcessoServico3').prop('checked', true);
        $('#chkAcessoServico2').prop('checked', true);

    }

    if (id_condicao == 1) {

        $('#chkAcessoServico1').prop('checked', true);
        $('#chkAcessoServico2').prop('checked', true);
        $('#chkAcessoServico3').prop('checked', true);

    }
}

function disableHorarioTiroleza(chk_brinquedo) {

    $("#divHoraTirolesa").hide(200);

    if (chk_brinquedo == 1) {
        $("#divHoraTirolesa").show(200);

    }
}

function disableHorarioMontanhaRussa(chk_brinquedo) {

    $("#divTrintaMontanhaRussa").hide(200);

    if (chk_brinquedo == 2) {
        $("#divTrintaMontanhaRussa").show(200);

    }
}

function disableHorarioCabum(chk_brinquedo) {

    // console.log('oi');

    $("#divQuinzeCabum").hide(200);

    if (chk_brinquedo == 3) {
        $("#divQuinzeCabum").show(200);

    }
}

function disableHorarioRodaGigante(chk_brinquedo) {

    $("#divHoraRodaGigante").hide(200);

    if (chk_brinquedo == 4) {
        $("#divHoraRodaGigante").show(200);

    }
}

function disableSintaOSom(chk_tipo_deficiencia) {

    $('#chkAcessoServico6').prop('checked', false);

    if (chk_tipo_deficiencia == 3) {

        $('#chkAcessoServico6').prop('checked', true);
    }
}

function disableAudioDescricao(chk_tipo_deficiencia) {

    $('#chkAcessoServico7').prop('checked', false);

    if (chk_tipo_deficiencia == 2) {

        $('#chkAcessoServico7').prop('checked', true);
    }
}

