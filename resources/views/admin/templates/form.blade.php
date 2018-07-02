<div class="modal fade" id="basicModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                <h4 class="modal-title" id="myModalLabel">Adding a record</h4>
            </div>
            <div class="modal-body">
                <h4>
                    <table class="table table-striped table-bordered table-hover table-condensed" border="2" width="50%">
                        <div class="input-group" >

                            <tr>
                                <td>
                                    <span class="input-group-addon" id="ip">Ip</span>
                                    <input type="text" id="ipv4" class="form-control" placeholder="Enter ip address" aria-describedby="ip" onkeyup="checkIp()" onkeypress="keyEnter()" autofocus>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="input-group-addon hidden"  id="span">Login</span>
                                    <input type="text" id="login" class="form-control hidden" placeholder="Enter login" aria-describedby="login" onkeyup="showSelect()"  onkeypress="keyEnter()" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="input-group-addon hidden"  id="spanSelect">Enable</span>
                                    <select name="select" class="form-control hidden" id="select" size="1" hidden>
                                        <option selected value="1">1</option>
                                        <option value="0">0</option>
                                    </select>
                                </td>
                            </tr>
                        </div>
                    </table>
                </h4>
            </div>
            <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="insertData()">Save</button></div>
        </div>
    </div>
</div>