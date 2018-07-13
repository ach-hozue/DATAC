<a class="btn btn-primary changeContraste" href="#" onclick="changeContrast()">Contraste élevé</a>
<script>
    function changeContrast() {
        console.log($('#css').attr('href'));
        if($('#css').attr('href') == 'mise_en_forme.css') {
            $('#css').replaceWith('<link id=css rel=stylesheet href=mise_en_forme_contrast.css>');
            $('.changeContraste').text('Contraste standard');
        }else{
            $('#css').replaceWith('<link id=css rel=stylesheet href=mise_en_forme.css>');
            $('.changeContraste').text('Contraste élevé');
        }
    }
</script>