$('#btnadd').click(function (e) {
  e.preventDefault();
  console.log('hello');
  let nm = $('#nameid').val();
  let em = $('#emailid').val();
  let pw = $('#passwordid').val();

  mydata = { name: nm, email: em, password: pw };
  //   console.log(mydata);
  $.ajax({
    url: 'include.php',
    method: 'POST',
    data: JSON.stringify(mydata),
    success: function (data) {
      console.log(data);
    },
  });
});
