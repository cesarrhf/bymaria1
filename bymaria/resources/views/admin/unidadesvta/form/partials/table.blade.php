
<div class="col-xs-12 col-sm-4 col-md-4">
    @if(isset($presentAsig))

     @else
      <h4>Asignaciones</h4>
     @endif
  <div class="table-responsive">

              <table class="table table-striped table-condensed">

                <tbody>
                  @if(isset($presentAsig))
                  @foreach($presentAsig as $item)
                  <tr class="rowPres" data-id="{{ $item->pres_id}}">
                    <td>{{ $item->pres_nombre}} </td>
                    <td><a href= "#!"><i class="fa fa-times"></i></a></td>
                 </tr>
                  @endforeach
                  @else
                  @endif
                </tbody>
              </table>
      </div>
</div>
