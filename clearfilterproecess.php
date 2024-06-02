<div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Filters</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" placeholder="Search..." class="form-control" id="s">
                                                </div>
                                                <div class="col-1">
                                                    <label class="form-label fs-4"><i class="bi bi-search"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-5">
                                            <label class="form-label">Acitve Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12" style="font-size: 16px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radiobtn" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newer To Oldest
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radiobtn" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest To Newer
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-5">
                                            <label class="form-label">By Quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12" style="font-size: 16px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radiobtn" id="l">
                                                <label class="form-check-label" for="l">
                                                    Low To High
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radiobtn" id="h">
                                                <label class="form-check-label" for="h">
                                                    High To Low
                                                </label>
                                            </div>
                                            <div class="col-12 mt-5">
                                                <label class="form-label">By Condition</label>
                                            </div>
                                            <div class="col-12">
                                                <hr width="80%" />
                                            </div>
                                            <div class="col-12" style="font-size: 16px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radiobtn" id="b">
                                                    <label class="form-check-label" for="b">
                                                        Brand New
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radiobtn" id="u">
                                                    <label class="form-check-label" for="u">
                                                        Used
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="offset-1 offset-lg-4 col-10 col-lg-4 d-grid my-3">
                                                <button class="btn btn-success mb-3" onclick="addfilters();">Search</button>
                                                <button class="btn btn-primary" onclick="clearfilters();">Clear Filters</button>
                                            </div>
                                        </div>
                                    </div>