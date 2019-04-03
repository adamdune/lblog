<div class="modal fade" id="modal-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{--type--}}}</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{--item--}}}</p>
      </div>
      <div class="modal-footer">
        <form action="" method="post">
          @csrf @method('DELETE')
          <button class="btn btn-danger" data-dismiss="modal">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function prepareDeleteModal(type, item, href){
    if (type === 'post'){
      $('#modal-delete .modal-title').text('Delete Post');
      $('#modal-delete .modal-body p').text('Are you sure you want to delete "' + item + '"?');
    } else {
      $('#modal-delete .modal-title').text('Delete Comment');
      $('#modal-delete .modal-body p').text('Are you sure you want to delete this comment?');
    }
    $('#modal-delete .modal-footer form').attr('action', href);
    $('#modal-delete .modal-footer form button').off('click', submitDeleteForm);
    $('#modal-delete .modal-footer form button').on('click', submitDeleteForm);
    $('#modal-delete').modal('show');
  }

  function submitDeleteForm(){
    $('#modal-delete .modal-footer form').submit();
    $('#modal-delete').modal('hide');
  }

</script>