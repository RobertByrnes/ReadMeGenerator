{* <pre>{$docComments|@print_r:1}</pre> *}
{* <pre>{$classComment|@print_r:1}</pre> *}
{* <pre>{$className}</pre> *}
{* <pre>{$properties|@print_r:1}</pre> *}

<div class="container">

    <div class="alert" role="alert">
        <div class="card">

            <div class="card-header bg-dark text-white">
                Class Name: <b>{$className}</b>
            </div>

            <div class="card-body">

                <div class="alert alert-info col-md-12">
                    <strong>Class Comment:</strong>
                    <span>{$classComment.comments.0}</span>
                </div><!-- .col-md-12 -->

                <div class="clearfix"></div>

                <div class="alert alert-success col-md-12">
                    <strong>Class Properties: </strong>
                    <div class="mt-1 mb-1"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Property Name</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$properties key=property item=info}
                                <tr>
                                    <td>{$info->name}</td>
                                    <td> Unkown </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                            
                </div><!-- .col-md-12 -->

                <div class="clearfix"></div>

                <div class="alert alert-success col-md-12">
                    <strong>Class Methods: </strong>
                    <div class="mt-1 mb-1"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Method Name</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Params</th>
                                <th scope="col">Returns</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$docComments key=item item=method}
                                <tr>
                                    <th scope="col">{$method.methodName}</th>
                                    <td>
                                        {if isset($method.comments) && !is_array($method.comments)}{$method.comments}
                                        {elseif isset($method.comments) && is_array($method.comments)}
                                            {foreach from=$method.comments key=comment item=item}
                                                <p>{$item}</p>
                                            {/foreach}
                                        {else} Undocumented {/if}
                                    </td>
                                    <td>
                                        {if isset($method.params) && !is_array($method.params)}{$method.params}
                                        {elseif isset($method.params) && is_array($method.params)}
                                            {foreach from=$method.params key=param item=item}
                                                <p>{$item}</p>
                                            {/foreach}
                                        {else} Undocumented {/if}
                                    </td>
                                    <td>
                                        {if isset($method.return) && !is_array($method.return)}{$method.return}
                                        {elseif isset($method.return) && is_array($method.return)}
                                            {foreach from=$method.return key=return item=item}
                                                <p>{$item}</p>
                                            {/foreach}
                                        {else} Undocumented {/if}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                            
                </div><!-- .col-md-12 -->

                <div class="alert alert-info col-md-12">
                    <b>Class Parent: </b>{$parent}
                </div><!-- .col-md-12 -->

                <div class="clearfix"></div>
            </div><!-- .card-body -->
        </div><!-- .card -->
    </div><!-- .alert -->
</div><!-- .container -->