<div class="d-flex">
                        <input type="hidden" name="sortfield" id="sortfield" value="{{request('sortfield')}}"/>
                        <input type="hidden" name="sorttype" id="sorttype" value="{{request('sorttype')}}"/>

                         <div>
                            <label>Show 
                            <select name="pageLength" class="form-control form-control-line" id="pageLength" on-change="searchFun()">                                   
                            <option value="10" {{SELECT('10',request('pageLength',10))}}>10</option>
                            <option value="25" {{SELECT('25',request('pageLength',25))}}>25</option>
                            <option value="50" {{SELECT('50',request('pageLength',50))}}>50</option>
                            <option value="100" {{SELECT('100',request('pageLength',100))}}>100</option>
                            </select>  
                            </label>
                         </div>
                         <div class="ml-auto">
                            <label>Search :<input type="search" placeholder="" class="form-control form-control-line"  id="keyword" value="{{request('keyword')}}">
                            </label>
                         </div>
                    </div>
                    