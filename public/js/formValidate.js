$(function() {

    var msgPadrao = 'Campo obrigatório.';
    var msgTamMax = 'Valor ultrapassa o máximo permitido.';

    $('#formPaciente').bootstrapValidator({
        excluded : [ ':disabled' ],

		feedbackIcons : {
			valid : 'glyphicon glyphicon-ok',
			invalid : 'glyphicon glyphicon-remove',
			validating : 'glyphicon glyphicon-refresh'
		},
        fields : {
            nome : {
                validators : {
                    notEmpty : {
                        message : msgPadrao
                    },
                    stringLength : {
                        max : 255,
                        message : msgTamMax
                    }
                }
            },
            dtNascimento : {
                validators : {
                    notEmpty : {
                        message : msgPadrao
                    }
                }
            },
            turma : {
                validators : {
                    notEmpty : {
                        message : msgPadrao
                    }
                }
            },
            naturalidade : {
                validators : {
                    notEmpty : {
                        message : msgPadrao
                    }
                }
            },
            telefone : {
                validators : {
                    notEmpty : {
                        message : msgPadrao
                    }
                }
            },
            sexo : {
                validators : {
                    notEmpty : {
                        message : msgPadrao
                    }
                }
            },
            raca : {
                validators : {
                    notEmpty : {
                        message : msgPadrao
                    }
                }
            },
            campus_id : {
                validators : {
                    notEmpty : {
                        message : msgPadrao
                    }
                }
            }
        }
    });

    $('#formTipoOperador').bootstrapValidator({
        excluded : [ ':disabled' ],

        feedbackIcons : {
            valid : 'glyphicon glyphicon-ok',
            invalid : 'glyphicon glyphicon-remove',
            validating : 'glyphicon glyphicon-refresh'
        },
        fields : {
            descricao : {
                validators : {
                    notEmpty : {
                        message : msgPadrao
                    },
                    stringLength : {
                        max : 255,
                        message : msgTamMax
                    }
                }
            }
        }
    });

    $('#formCampus').bootstrapValidator({
        excluded : [ ':disabled' ],

        feedbackIcons : {
            valid : 'glyphicon glyphicon-ok',
            invalid : 'glyphicon glyphicon-remove',
            validating : 'glyphicon glyphicon-refresh'
        },
        fields : {
            nome : {
                validators : {
                    notEmpty : {
                        message : msgPadrao
                    },
                    stringLength : {
                        max : 255,
                        message : msgTamMax
                    }
                }
            }
        }
    });
});

// Validação para CPF
// https://github.com/nghuuphuoc/bootstrapvalidator/issues/187
(function(e) {
    e.fn.bootstrapValidator.validators.cpfVal = {
        html5Attributes : {
            message : "message"
        },
        validate : function(e, t, n) {
            var r = t.val();
            if (r == "") {
                return true
            }
            r = r.replace(".", "");
            r = r.replace(".", "");
            cpf = r.replace("-", "");
            while (cpf.length < 11)
                cpf = "0" + cpf;
            var s = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
            var o = [];
            var u = new Number;
            var a = 11;
            for (i = 0; i < 11; i++) {
                o[i] = cpf.charAt(i);
                if (i < 9)
                    u += o[i] * --a
            }
            if ((x = u % 11) < 2) {
                o[9] = 0
            } else {
                o[9] = 11 - x
            }
            u = 0;
            a = 11;
            for (y = 0; y < 10; y++)
                u += o[y] * a--;
            if ((x = u % 11) < 2) {
                o[10] = 0
            } else {
                o[10] = 11 - x
            }
            if (cpf.charAt(9) != o[9] || cpf.charAt(10) != o[10]
                || cpf.match(s))
                return false;
            return true
        }
    }
})(window.jQuery);

/**
 * Função usada como coringa, apenas para setar o campo como inválido
 *
 * @param e
 */
(function(e) {
    e.fn.bootstrapValidator.validators.outro = {
        html5Attributes : {
            message : "message"
        },
        validate : function(e, t, n) {
            return true
        }
    }
})(window.jQuery);
