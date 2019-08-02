@extends('layout.layout')

@section('content')

<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">
       <div class="row">
        <div class="col-md-12">

          @if (Session::has('message'))
          <div class="alert alert-info">{{ Session::get('message') }}</div>
          @endif

        </div>
      </div>
      <div class="row">
        <div class="col-md-10">
          <strong>All Contact Listing</strong>
        </div>
        <div class="col-md-2">
          <a href="{{url('contact-us')}}" class="btn btn-info pull-right">Add Contact</a>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Message</th>
            <th scope="col">Created</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacts as $contact)
          <tr id="tr_{{$contact->id}}">
            <th scope="row">{{$contact->id}}</th>
            <td><a href="/contacts/{{$contact->id}}">{{$contact->name}}</a></td>
            <td>{{$contact->email}}</td>
            <td>{{$contact->message}}</td>
            <td>{{$contact->created_at}}</td>
            <td>
              <a href="{{ url('contacts',$contact->id) }}" class="btn btn-danger btn-sm"
               data-tr="tr_{{$contact->id}}"
               data-toggle="confirmation"
               data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
               data-btn-ok-class="btn btn-sm btn-danger"
               data-btn-cancel-label="Cancel"
               data-btn-cancel-icon="fa fa-chevron-circle-left"
               data-btn-cancel-class="btn btn-sm btn-default"
               data-title="Are you sure you want to delete ?"
               data-placement="left" data-singleton="true">
               Delete
             </a>
           </td>
         </tr>
         @endforeach
       </tbody>
     </table>
     <?php echo $contacts->render(); ?>
   </div>
 </div>

</div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('[data-toggle=confirmation]').confirmation({
      rootSelector: '[data-toggle=confirmation]',
      onConfirm: function (event, element) {
        element.trigger('confirm');
      }
    });

    $(document).on('confirm', function (e) {
      var ele = e.target;
      e.preventDefault();

      $.ajax({
        url: ele.href,
        type: 'DELETE',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
          if (data['success']) {
            $("#" + data['tr']).slideUp("slow");
            alert(data['success']);
          } else if (data['error']) {
            alert(data['error']);
          } else {
            alert('Whoops Something went wrong!!');
          }
        },
        error: function (data) {
          alert(data.responseText);
        }
      });

      return false;
    });
  });
</script>
@endsection
