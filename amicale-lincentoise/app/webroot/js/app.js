$(document).ready(function(){

  /**************************/
  /* ACTION DES FORMULAIRES */
  /**************************/

  $('#selectDay').on('change',function(){
    window.location.href=$('#selectDay option:selected').attr('value');
  });

  $('#UselectDay').on('change',function(){
    window.location.href=$('#UselectDay option:selected').attr('value');
  });

  $('#selectDayResult').on('change',function(){
    var value = $('#selectDayResult option:selected').attr('value');
    if(value == "all"){
      $('.day-result').show();
    }else{
      var day = '#day_'+value;
      $('.day-result').hide();
      $(day).fadeIn(500);
    }
  });

  $('#selectDayCalendar').on('change',function(){
    var value = $('#selectDayCalendar option:selected').attr('value');
    if(value == "all"){
      $('.day-calendar').show();
    }else{
      var day = '#calendar_'+value;
      $('.day-calendar').hide();
      $(day).fadeIn(500);
    }
  });


  $('.submit-results').click(function() {
    $('#setResultsForm').submit();
  });

  /************************************/
  /* CHANGEMENT AUTOMATIQUE DES DATES */
  /************************************/

  $('#daySelectDay').on('change', function(){
    var value = $('#daySelectDay option:selected').attr('value');
    $('.selectDay').each(function(){
      $(this).find("option[value='"+value+"']").attr("selected","selected");
    });
  });

  $('#daySelectMonth').on('change', function(){
    var value = $('#daySelectMonth option:selected').attr('value');
    $('.selectMonth').each(function(){
      $(this).find("option[value='"+value+"']").attr("selected","selected");
    });
  });

  $('#daySelectYear').on('change', function(){
    var value = $('#daySelectYear option:selected').attr('value');
    $('.selectYear').each(function(){
      $(this).find("option[value='"+value+"']").attr("selected","selected");
    });
  });

  /*************************************************/
  /* CHANGEMENT AUTOMATIQUE DES DATES (UPDATE DAY) */
  /*************************************************/

  $('#UdaySelectDay').on('change', function(){
    var value = $('#UdaySelectDay option:selected').attr('value');
    $('.UselectDay').each(function(){
      $(this).find("option[value='"+value+"']").attr("selected","selected");
    });
  });

  $('#UdaySelectMonth').on('change', function(){
    var value = $('#UdaySelectMonth option:selected').attr('value');
    $('.UselectMonth').each(function(){
      $(this).find("option[value='"+value+"']").attr("selected","selected");
    });
  });

  $('#UdaySelectYear').on('change', function(){
    var value = $('#UdaySelectYear option:selected').attr('value');
    $('.UselectYear').each(function(){
      $(this).find("option[value='"+value+"']").attr("selected","selected");
    });
  });


  /***************************************/
  /* MISE EN PLACE DES HEURES PAR DEFAUT */
  /***************************************/

  $('.selectHour0').find("option[value='20']").attr("selected","selected");
  $('.selectMinute0').find("option[value='00:00']").attr("selected","selected");

  $('.selectHour1').find("option[value='21']").attr("selected","selected");
  $('.selectMinute1').find("option[value='00:00']").attr("selected","selected");

  $('.selectHour2').find("option[value='20']").attr("selected","selected");
  $('.selectMinute2').find("option[value='15:00']").attr("selected","selected");

  $('.selectHour3').find("option[value='21']").attr("selected","selected");
  $('.selectMinute3').find("option[value='15:00']").attr("selected","selected");

  $('.selectHour4').find("option[value='22']").attr("selected","selected");
  $('.selectMinute4').find("option[value='15:00']").attr("selected","selected");

  $('.selectHour5').find("option[value='23']").attr("selected","selected");
  $('.selectMinute5').find("option[value='15:00']").attr("selected","selected");

  $('.selectHour6').find("option[value='00']").attr("selected","selected");
  $('.selectMinute6').find("option[value='15:00']").attr("selected","selected");


  /* FIX BYE */

  $('.SelectTeamAway4 .selectTeamAddDay').find("option[value='100000']").attr("selected","selected");
  $('.SelectStatus4 #selectStatus').find("option[value='4']").attr("selected","selected");


  $('.SelectTeamAway4 .UselectTeam').find("option[value='100000']").attr("selected","selected");
  $('.SelectStatus4 #UselectStatus').find("option[value='4']").attr("selected","selected");


  /******************/
  /* BOUCLE SABLIER */
  /******************/

  setInterval(function() {
      if($('i.hourglass').hasClass('fa-hourglass-start')){
        $('i.hourglass').removeClass('fa-hourglass-start').addClass('fa-hourglass-half');
      }else if($('i.hourglass').hasClass('fa-hourglass-half')){
        $('i.hourglass').removeClass('fa-hourglass-half').addClass('fa-hourglass-end');
      }else{
        $('i.hourglass').removeClass('fa-hourglass-end').addClass('fa-hourglass-start');
      }
  }, 600);

  /*************/
  /* TEST DATE */
  /*************/

  $('#addDatePicker, #updateDatePicker, .selectDatePicker').datepicker({ dateFormat: 'dd/mm/yy' });

  $('#addDatePicker, #updateDatePicker').on('change', function(){
    var value = $('#addDatePicker, #updateDatePicker').datepicker().val();    
    $('.selectDatePicker').each(function(){
      $(this).val(value);
    });
  });


  /************/
  /* TOP LINK */
  /************/

  $('body').append('<span class="top"><a href="#body" class="top_link" title="Revenir en haut de page"><i class="fa fa-angle-up"></i></a></span>');
  $('.top_link').css({
    'position'      : 'fixed',
    'right'         : '40px',
    'bottom'        : '50px',
    'display'       : 'none',
    'width'         : '50px',
    'height'        : '50px',
    'text-align'    : 'center',
    'line-height'   : '50px',
    'color'         : '#FFF',
    'font-size'     : '40px',
    'background'    : 'rgba(0,0,0,0.2)',      
    'z-index'       : '2000'
  });

  $(window).scroll(function(){
    posScroll = $(document).scrollTop();
    if(posScroll >=550)
      $('.top_link').fadeIn(600);
    else
      $('.top_link').fadeOut(600);
  });

  $('.top_link').on('click', function() { // Au clic sur un élément
    var page = $(this).attr('href'); // Page cible
    var speed = 750; // Durée de l'animation (en ms)
    $('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
    return false;
  });



  /***************************/
  /* ORBIT CUSTOM NAVIGATION */
  /***************************/


  /*$(".next-slide").click(function() {
    $(".days-orbit-content").siblings(".orbit-next").click();
    $(".days-orbit-content").siblings(".orbit-timer").click(); // Remove this line to pause the orbit. (it pauses whenever you change slides by default)
  });

  $(".prev-slide").click(function() {
      $(".days-orbit-content").siblings(".orbit-prev").click();
      $(".days-orbit-content").siblings(".orbit-timer").click(); // Remove this line to pause the orbit. (it pauses whenever you change slides by default)
  });*/


  /********/
  /* AJAX */
  /********/

  $('#selectDaySlide').on('change',function(){
    /*var value = $('#selectDayResult option:selected').attr('value');
    if(value == "all"){
      $('.day-result').show();
    }else{
      var day = '#day_'+value;
      $('.day-result').hide();
      $(day).fadeIn(500);
    }*/
    var urlAjax = '/amicale-lincentoise/calendrier/journee/'+$('#selectDaySlide option:selected').attr('value');
    //alert(urlAjax);
    $.ajax({
      url: urlAjax,
      cache: false,
      type: 'GET',
      dataType: 'HTML',
      success: function (data) {
          $('.day-container').html("");
          $('.day-container').html("<div class='loader-img'><img src='/amicale-lincentoise/img/loading-icon.gif' alt='Loading...'/></div>");
          setTimeout(function(){
              $('.day-container').fadeOut(100, function() {
                  $('.day-container').html(data);
                  $('.day-container').fadeIn(300);
              });
              /*$('.result-container').html("");
              $('.result-container').html(data); */
          }, 500); 
      }
    });

  });


  $('#selectResultSlide').on('change',function(){
    /*var value = $('#selectDayResult option:selected').attr('value');
    if(value == "all"){
      $('.day-result').show();
    }else{
      var day = '#day_'+value;
      $('.day-result').hide();
      $(day).fadeIn(500);
    }*/
    var urlAjax = '/amicale-lincentoise/resultats/resultat/'+$('#selectResultSlide option:selected').attr('value');
    //alert(urlAjax);
    $.ajax({
      url: urlAjax,
      cache: false,
      type: 'GET',
      dataType: 'HTML',
      success: function (data) {
          //alert(data);
          $('.result-container').html("");
          $('.result-container').html("<div class='loader-img'><img src='/amicale-lincentoise/img/loading-icon.gif' alt='Loading...'/></div>");
          setTimeout(function(){
              $('.result-container').fadeOut(100, function() {
                  $('.result-container').html(data);
                  $('.result-container').fadeIn(300);
              });
              /*$('.result-container').html("");
              $('.result-container').html(data); */
          }, 500);
      }
    });
  });


  $(document).on('click','#days .nav-slide',function(){    
   
    var id = $(this).attr('data-id-day');
    var urlAjax = '/amicale-lincentoise/calendrier/journee/'+id;
    //alert(urlAjax);
    $.ajax({
      url: urlAjax,
      cache: false,
      type: 'GET',
      dataType: 'HTML',
      success: function (data) {
          //alert(data);
          $('.day-container').html("");
          $('.day-container').html("<div class='loader-img'><img src='/amicale-lincentoise/img/loading-icon.gif' alt='Loading...'/></div>");
          setTimeout(function(){
              $('.day-container').fadeOut(100, function() {
                  $('.day-container').html(data);
                  $('.day-container').fadeIn(300);
              });
              /*$('.day-container').html("");
              $('.day-container').html(data); */
          }, 500); 
      }
    });
  });   


  $(document).on('click','#results .nav-slide',function(){    
   
    var id = $(this).attr('data-id-day');
    var urlAjax = '/amicale-lincentoise/resultats/resultat/'+id;
    //alert(urlAjax);
    $.ajax({
      url: urlAjax,
      cache: false,
      type: 'GET',
      dataType: 'HTML',
      success: function (data) {
          //alert(data);
          $('.result-container').html("");
          $('.result-container').html("<div class='loader-img'><img src='/amicale-lincentoise/img/loading-icon.gif' alt='Loading...'/></div>");
          setTimeout(function(){
              $('.result-container').fadeOut(100, function() {
                  $('.result-container').html(data);
                  $('.result-container').fadeIn(300);
              });
              /*$('.result-container').html("");
              $('.result-container').html(data); */
          }, 500);
          //$('.result-container').html("");
          //$('.result-container').html(data);         
      }
    });
  }); 




  $('#search-player-input').on('input',function(){
    /*var value = $('#selectDayResult option:selected').attr('value');
    if(value == "all"){
      $('.day-result').show();
    }else{
      var day = '#day_'+value;
      $('.day-result').hide();
      $(day).fadeIn(500);
    }*/
    //alert("test");
    //$('#players-list').html("");
    
    var urlAjax = '/amicale-lincentoise/joueurs/liste/'+$('#search-player-input').val();
    //alert(urlAjax);
    $.ajax({
      url: urlAjax,
      cache: false,
      type: 'GET',
      dataType: 'HTML',
      success: function (data) {
         //alert(data);
         $('.tbody-players-list').html("");         
         $('.tbody-players-list').html("<tr><td colspan='7'><div class='loader-img'><img src='/amicale-lincentoise/img/loading-icon.gif' alt='Loading...'/></div></td></tr>");
          setTimeout(function(){
              $('.tbody-players-list').fadeOut(100, function() {
                  $('.tbody-players-list').html(data);
                  $('.tbody-players-list').fadeIn(300);
              });
              /*$('.result-container').html("");
              $('.result-container').html(data); */
          }, 500);       
          
      }
    });
  });


  $(document).on('submit', '#PlayerAddplayerAjaxForm' ,function(e) {
    e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
 
    var $this = $(this); // L'objet jQuery du formulaire

    // Je récupère les valeurs
    var name = $('#Name').val();
    var firstname = $('#PlayerFirstname').val();
    var id_team = $('#PlayerIdTeam').val();
    var level = $('#PlayerLevel').val();
    //alert("test");
    var urlAjax = '/amicale-lincentoise/players/addplayerajax';
    $.ajax({
      url: urlAjax, // Le nom du fichier indiqué dans le formulaire
      type: $this.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
      data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
      success: function(data) { // Je récupère la réponse du fichier PHP
        //alert(data); // J'affiche cette réponse


        $('.players-table').html(""); 
        $('.players-table').html(data);
        $('#PlayerAddplayerAjaxForm').val("");      
       
      }

    });
  });


  /* SELECT TEAM */

  $("select.selectTeamAddDay").change(function() {

    var selectedValue = $(this).val() ;

    $("select.selectTeamAddDay option[value="+selectedValue+"]").each(function(){
      if(!$(this).is(':selected')) {
        $(this).prop('disabled', true);
     }
    });
  });

  /*var valid = false;

  $('input#UserPassword2').keyup(function(){
    var password1 = $('input#UserPassword1').val();
    var password2 = $('input#UserPassword2').val();
    if(password1 == password2){
      $('input#UserPassword1').removeClass("red-input").addClass("green-input");
      $('input#UserPassword2').removeClass("red-input").addClass("green-input");  
      valid = true;
    }else{
      $('input#UserPassword1').removeClass("green-input").addClass("red-input");
      $('input#UserPassword2').removeClass("green-input").addClass("red-input");  
      valid = false;   
    }
  });


  $('button.adduser-button').click(function(){

    if($('input#UserPassword1').val() == "" 
      || $('input#UserPassword2').val() == "" 
      || $('input#UserName').val() == "" 
      || $('input#UserFirstname').val() == "" 
      || $('input#UserUsername').val() == ""){
        valid = false;  
    }

    $('#UserAdduserForm').submit(function(){   
      //alert(valid);     
      if(!valid){
        return false;
      }else{
        return true;
      }
    });                    
      
  });  */



  /*$(document).on('click','.deleteUser',function(e){    
      e.preventDefault();
      var id = $(this).attr('data-id');
      var urlAjax = '/amicale-lincentoise/users/delete/'+id;
      //alert(urlAjax);
      $.ajax({
        url: urlAjax,
        cache: false,
        type: 'POST',        
        success: function (data) {
               
        }
      });
    });*/ 

});
