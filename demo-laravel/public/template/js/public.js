
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMore()
{
    var page = new Number($('#page').val());
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        data : { page },
        url : '/services/load-product',
        success : function (result) {
            
            if (result.data !== '') {
                $('#loadProduct').append(result.data);
                page=page+1;
                $('#page').val(page);
                console.dir(page);
            } else {
                alert('Đã load xong Sản Phẩm');
                $('#btnLoadMore').css('display', 'none');
            }
        }
    })
}