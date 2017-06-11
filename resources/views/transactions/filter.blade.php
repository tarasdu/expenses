<div class="collapse {{ ($isRequest || $errors->any()) ? "in" : "" }}" id="transactionFilter">
    <br>
    <form method="GET" action="/">
        <div class="well">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('startDate') ? ' has-error' : '' }}">
                        <label for="startDate" class="control-label">Початкова дата</label>
                        <input type="date" name="startDate" class="form-control" id="startDate" value="{{ old("startDate", $startDate)}}">
                        @if($errors->has('startDate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('startDate') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">
                        <label for="endDate" class="control-label">Кінцева дата</label>
                        <input type="date" name="endDate" class="form-control" id="endDate" value="{{ old("endDate", $endDate)}}">
                        @if($errors->has('endDate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('endDate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Категорія&nbsp;&nbsp;</strong>
                        <div class="panel panel-default">
                            <div class="panel-body cat">
                                @foreach ($categories as $category)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="categories[{{ $category->id }}]"
                                            @if ($isRequest && $categoryIds)
                                                {{ in_array($category->id, $categoryIds) ? "CHECKED" : "" }}
                                            @else
                                                {{ "" }}
                                            @endif
                                            > {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Мітки&nbsp;&nbsp;</strong>
                        <div class="panel panel-default">
                            <div class="panel-body tag">
                                @foreach ($tags as $tag)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="tags[{{ $tag->name }}]"
                                            @if ($isRequest && $tagsNames)
                                                {{ in_array($tag->name, $tagsNames) ? "CHECKED" : "" }}
                                            @else
                                                {{ "" }}
                                            @endif
                                            > {{ $tag->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary " value="Застосувати">
            <a href="/" class="btn btn-default" role="button">Показати все</a>
        </div>
    </form>
</div>
