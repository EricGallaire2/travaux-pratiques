


<footer class="container-fluid alert-warning">
    <div class="row" id="foot">
        <div class="col">
            <div class="p-5">
            <h3>Informations</h3>
            <li>Du texte</li>
            <li>Du texte</li>
            <li>Du texte</li>
            <li>Du texte</li>
            <li>Du texte</li>
            </div>
        </div>
        <div class="col">
            <div class="p-5">
            <h3>Informations</h3>
            <li>Du texte</li>
            <li>Du texte</li>
            <li>Du texte</li>
            <li>Du texte</li>
            <li>Du texte</li>
            </div>
        </div>
    </div>
</footer>



<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
    $('body').append('<div id="toTop" style="position: fixed; bottom: 30px;	right: 50px; cursor: pointer; display: none; z-index:10; color:#ffffff; " class="border p-2">Remonter</div>');
    $(window).scroll(function () {
        if ($(this).scrollTop() >10) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    }); 
    $('#toTop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 500);
        return false;
    });
});
</script>
