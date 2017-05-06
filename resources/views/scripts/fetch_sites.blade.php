<script>

function fetch_select(val)
{

 $.ajax({
 type: 'post',
 url: "/fetch_sites",
 data: {
  manufacturer_id:val
 },
 dataType: "json",

 success: function (data) {

  var select_site = document.getElementById("sites");


  // clear out previous options
  select_site.innerHTML = "";

  for (var i=0; i<data.length; i++) {
      select_site.options[select_site.options.length] = new Option(data[i].model, data[i].id);
      var opts = (select_site.childNodes);
      opts[i].setAttribute("data-parent", i);
      opts[i].setAttribute("class", "site_option");
  }


}

 });

}

</script>