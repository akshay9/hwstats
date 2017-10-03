$( document ).ready(function() {
    $("span.stars").hover(function() {
      $(this).tooltip("show");
      });
    $("td.popover1").hover(function() {
      $(this).popover('show');
      });
    $(".tooltip2").hover(function() {
      $(this).tooltip('show');
      });
    $('body').on('hidden.bs.modal', '.modal', function () {
      $(this).removeData('bs.modal');
    });
    $('.skill_popover').popover({ 
      html : true,
      container : 'body',
      trigger : 'hover',
      content: function() {
        return $('#popover_content_wrapper').html();
      }
    });
    $('.secondary_skill_popover').popover({ 
      html : true,
      container : 'body',
      trigger : 'hover',
      content: function() {
        return $('#popover_content_wrapper_2').html();
      }
    });
    $(".tooltip1").tooltip({
        html: true,
        container: 'body',
        trigger: 'hover'
      });
	/*  
    $("#hw_id").change(function() {
      $.get("{{ URL::to('users/check') }}?atri=hw_id&value="+ $("#hw_id").val() ,function(data,status){
        if (status == "success"){
          var rArray = JSON.parse(data);
          if (rArray.status == "success"){
            $("#hw_name").val(rArray.info);
            $("#hw_id").val(rArray.team_id);
            $("#hw_name").removeAttr("disabled");
          } else {
            $("#hw_name").removeAttr("disabled");
            $("#hw_id").val(rArray.team_id);
            $("#alerts").append("<div class=\"alert alert-warning\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button><strong>Oops !!</strong> We were unable to get your team name please fill your team name below.</div>");
          }
        }
      });
    });
    $("#start").focus(function(){
      $("#start").datepicker('show').on('changeDate', function(){$("#start").datepicker('hide');});
    });
	*/
    $("#adv_filer_show").click(function () {
        $(this).attr("style", "display:none;");
        $("#adv_search").attr("style", "");
    });
})