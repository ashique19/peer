<div class="modal fade modal-theme-1" id="v2-modal" tabindex="-1" role="dialog" data-show="true" aria-labelledby="v2-modal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            
            <aside class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </aside>
            
            <article class="modal-body">
            
                <section class="row text-center">
                    <h2 class="page-title blue-text">EXISTING BUYERS</h2>
                </section>
                
                @include('public.partials.notice')
                
            </article>
            
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $('#v2-modal').modal('show');
    
</script>