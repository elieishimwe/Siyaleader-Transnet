<!-- Modal Default -->
<div class="modal fade modalAddressBook" id="modalAddressBook" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Address Book</h4>
            </div>
            <div class="modal-body">

                  <!-- Alternative -->
                  <div class="block-area" id="alternative-buttons">
                      <a class="btn btn-sm" data-toggle="modal" onClick="launchAddContactModal();" data-target=".modalAddContactModal">
                       Add Contact
                      </a>
                  </div>

                <!-- Responsive Table -->
                <div class="block-area" id="responsiveTable">
                    @if(Session::has('success'))
                    <div class="alert alert-info alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <div class="table-responsive overflow">
                        <table class="table tile table-striped" id="addressBookTable">
                            <thead>
                              <tr>
                                    <th>First Name</th>
                                    <th>Surname</th>
                                    <th>Cellphone</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                              </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">

            </div>


        </div>
    </div>
</div>
