$(document).ready(() => {
  $(".nav_menu").on("click", () => {
    $(".nav_sidebar").toggle();
    if ($(".nav_sidebar").is(":visible")) {
      $(".nav_menu").html("<span>&times;</span>").css("font-size", "30px");
    } else {
      $(".nav_menu").html("<span>&#9776;</span>").css("font-size", "20px");
    }
  });
});
