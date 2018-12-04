$('#confirmDelete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var recipient = button.data('delete');
  var modal = $(this);
  modal.find('#id-to-delete').val(recipient);
});