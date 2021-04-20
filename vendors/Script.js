$(document).ready(function(){
    $('#password').keyup(function(index) {

        //dapatkan karakter di field password
        let karakter = $(this).val();

        //hitung karakter dari field password
        let totalkarakter =karakter.length;

        if(totalkarakter >= 6){
            $('.status').removeClass('lemah'); //hapus class lemah

            $('.status').text('kuat'); //string menjadi kuat
            $('.status').addClass('kuat'); //tambah class sukses
        }else{
            $('.status').removeClass('kuat'); //hapus class kuat

            $('.status').text('lemah'); //string menjadi lemah
            $('.status').addClass('lemah'); //tambah class sukses
        }
    });
});