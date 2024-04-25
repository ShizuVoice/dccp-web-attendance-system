/*
document.getElementById('confirmBtn').addEventListener('click', function() {
  // Add your logic here for what happens when the user confirms their data
  // For example, you might want to submit the form or perform some validation
  $('#confirmModal').modal('hide'); // Close the modal
 });
*/

document.getElementById('confirmBtn').addEventListener('click', function () {
  var form = $('#scheduleForm');
  $.ajax({
    type: "POST",
    url: form.attr('action'), // This is the URL to which the form data is submitted
    data: form.serialize(), // Collects all form data
    success: function (data) {
      console.log('Submission was successful.');
      console.log(data); // You can handle the response from the server here
      $('#confirmModal').modal('hide'); // Close the modal
      $('#resultModalBody').text('Action was successful.');
      $('#resultModal').modal('show');
    },
    error: function (data) {
      console.log('An error occurred.');
      console.log(data); // Handle errors here
      $('#resultModalBody').text('An error occurred.');
      $('#resultModal').modal('show');
    },
  });
});
