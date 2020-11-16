$('#escolaAluno').on('change', function(e) {
    console.log(e);
    var escola_id = e.target.value;

    $.get('/json-ano?escola_id=' + escola_id, function(data) {
        console.log(data);
        $('#anoLetivo').empty();
        $('#anoLetivo').append('<option disabled selected>Ano letivo</option>');
        $('select').material_select();
        $.each(data, function(index, anoObj) {
            console.log(anoObj);
            $('#anoLetivo').append('<option value="' + anoObj.id + '">' + anoObj.etapa + '</option>');
            $('select').material_select();
        })
    });
})
$('#escolaprojeto').on('change', function(e) {
    console.log(e);
    var escola_id = e.target.value;

    $.get('/json-categorias-projeto?escola_id=' + escola_id, function(data) {
        console.log(data);
        $('#categorias').empty();
        $('#categorias').append('<option disabled selected>Categoria</option>');
        $('select').material_select();
        $.each(data, function(index, categoriasObj) {
            console.log(categoriasObj);
            $('#categorias').append('<option value="' + categoriasObj.id + '">' + categoriasObj.categoria + '</option>');
            $('select').material_select();
        })
    });
    var turno = $('#turno').val();

    $.get('/json-professores-lista?escola_id=' + escola_id + '&turno='+ turno  , function(data) {
        console.log(data);
        $('#orientador').empty();
        $('#orientador').append('<option disabled selected>Orientador</option>');
        $('#coorientador').empty();
        $('#coorientador').append('<option disabled selected>Coorientador</option>');
        $('select').material_select();
        $.each(data, function(index, professoresObj) {
            $('#orientador').append('<option value="' + professoresObj.id + '">' + professoresObj.name + '</option>');
            $('select').material_select();
        })
        $.each(data, function(index, professoresObj) {
            $('#coorientador').append('<option value="' + professoresObj.id + '">' + professoresObj.name + '</option>');
            $('select').material_select();
        })
    });
});

$('#escolasuplente').on('change', function(e) {
    console.log(e);
    var escola_id = e.target.value;
    $.get('/json-categorias-suplente?escola_id=' + escola_id, function(data) {
        console.log(data);
        $('#categorias').empty();
        $('#categorias').append('<option disabled selected>Categoria</option>');
        $('select').material_select();
        $.each(data, function(index, categoriasObj) {
            console.log(categoriasObj);
            $('#categorias').append('<option value="' + categoriasObj.id + '">' + categoriasObj.categoria + '</option>');
            $('select').material_select();
        })
    });
    var turno = $('#turno').val();
    console.log(turno);
    $.get('/json-professores-lista?escola_id=' + escola_id + '&turno='+ turno , function(data) {
        console.log(data);
        $('#orientador').empty();
        $('#orientador').append('<option disabled selected>Orientador</option>');
        $('#coorientador').empty();
        $('#coorientador').append('<option disabled selected>Coorientador</option>');
        $('select').material_select();
        $.each(data, function(index, professoresObj) {
            $('#orientador').append('<option value="' + professoresObj.id + '">' + professoresObj.name + '</option>');
            $('select').material_select();
        });
        $.each(data, function(index, professoresObj) {
            $('#coorientador').append('<option value="' + professoresObj.id + '">' + professoresObj.name + '</option>');
            $('select').material_select();
        })
    });
});

$('#categorias').on('change', function(e) {
    console.log(e);
    var categoria_id = e.target.value;

    var escola_id = $('#escolaprojeto').val();

    if(escola_id == undefined){
        if($('#escolasuplente').val() == undefined){
            escola_id = null;
            escola_id = parseInt($('#id_escola').val());
            console.log(escola_id);
            $.get('/json-alunos-lista-escola?categoria_id=' + categoria_id + '&escola_id=' + escola_id , function(data) {
                console.log(data);
                $('#alunos').empty();
                $('#alunos').append('<option disabled selected>Selecione os alunos...</option>');
                $('select').material_select();
                $.each(data, function(index, alunosObj) {
                    $('#alunos').append('<option value="' + alunosObj.id + '">' + alunosObj.name + '</option>');
                    $('select').material_select();
                });
            });
        }else{
            
            escola_id = $('#escolasuplente').val();
            $.get('/json-alunos-lista?categoria_id=' + categoria_id + '&escola_id=' + escola_id , function(data) {
                console.log(data);
                $('#alunos').empty();
                $('#alunos').append('<option disabled selected>Selecione os alunos...</option>');
                $('select').material_select();
                $.each(data, function(index, alunosObj) {
                    $('#alunos').append('<option value="' + alunosObj.id + '">' + alunosObj.name + '</option>');
                    $('select').material_select();
                });
            });
        }
       
    }else{
        $.get('/json-alunos-lista?categoria_id=' + categoria_id + '&escola_id=' + escola_id , function(data) {
            console.log(data);
            $('#alunos').empty();
            $('#alunos').append('<option disabled selected>Selecione os alunos...</option>');
            $('select').material_select();
            $.each(data, function(index, alunosObj) {
                $('#alunos').append('<option value="' + alunosObj.id + '">' + alunosObj.name + '</option>');
                $('select').material_select();
            });
        });
    }


});



$('#categoria').on('change', function(e) {
    console.log(e);
    var categoria_id = e.target.value;
    $.get('/json-aluno?categoria_id=' + categoria_id, function(data) {
        console.log(data);
        $('#alunos').empty();
        $('#alunos').append('<option disabled selected>Selecione os alunos...</option>');
        $('select').material_select();
        $.each(data, function(index, alunosObj) {
            $('#alunos').append('<option value="' + alunosObj.id + '">' + alunosObj.name + '</option>');
            $('select').material_select();
        })
    });
});
$('#projeto').on('change', function(e) {
    var projeto_id = e.target.value;
    console.log('id: ' + projeto_id);
    $.get('/json-projeto-categoria?categoria=' + projeto_id, function(data) {
        console.log('teste');
        $('#projetos').empty();
        $('#projetos').append('<option disabled selected>Selecione o projeto...</option>');
        $('select').material_select();
        $.each(data, function(index, projetoObj) {
            $('#projetos').append('<option value="' + projetoObj.id + '">' + projetoObj.titulo + '</option>');
            $('select').material_select();
        })
    });
});

function fMasc(objeto,mascara) {
    obj=objeto
    masc=mascara
    setTimeout("fMascEx()",1)
}

function fMascEx() {
    obj.value=masc(obj.value)
}

function mTel(tel) {
    tel=tel.replace(/\D/g,"")
    tel=tel.replace(/^(\d)/,"($1")
    tel=tel.replace(/(.{3})(\d)/,"$1) $2")
    if(tel.length == 9) {
        tel=tel.replace(/(.{1})$/,"-$1")
    } else if (tel.length == 10) {
        tel=tel.replace(/(.{2})$/,"-$1")
    } else if (tel.length == 11) {
        tel=tel.replace(/(.{3})$/,"-$1")
    } else if (tel.length == 12) {
        tel=tel.replace(/(.{4})$/,"-$1")
    } else if (tel.length > 12) {
        tel=tel.replace(/(.{4})$/,"-$1")
    }
    return tel;
}

function mCPF(cpf){
    cpf=cpf.replace(/\D/g,"")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
    return cpf;
}

function mCEP(cep){
    cep=cep.replace(/\D/g,"")
    cep=cep.replace(/^(\d{5})(\d)/,"$1-$2")
    return cep;
}

function mNum(num){
    num=num.replace(/\D/g,"")
    return num;
}


