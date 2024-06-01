
$(function (){
    // const toastElement = document.getElementById('kt_docs_toast_toggle');

    Livewire.on('success', (message) => {
        // $('#toast-title').html('Success');
        // $('#toast-body').html(message);
        // const toast = bootstrap.Toast.getOrCreateInstance(toastElement);
        // toast.show();
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 2000,
            padding: '2em'
        })
    });
    Livewire.on('error', (message) => {
        Swal.fire({
            title: 'Error!',
            text: message,
            icon: 'error',
            padding: '2em'
        })
    });
    Livewire.on('deleting', (data) => {
        Swal.fire({
            title: 'warning',
            text: 'Are you sure you want to delete this ' + data.name,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            padding: '2em'
        }).then(function (result) {
            if (result.value) {
                Livewire.dispatch('delete', {id:data.id});

            }
        })
    });
    Livewire.on('closing', () => {
        Swal.fire({
            title: 'warning',
            text: "Are you sure you would like to cancel?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, cancel it!',
            cancelButtonText:'No, return',
            padding: '2em'
        }).then(function (result) {
            if (result.value) {
                closeModal()
            }
        })
    });
    // Livewire.on('page', (message) => {
    //     $('#toast-title').html('pagination');
    //     $('#toast-body').html(message);
    //     const toast = bootstrap.Toast.getOrCreateInstance(toastElement);
    //     toast.show();
    //     // Swal.fire({
    //     //     position: 'top-end',
    //     //     title: message,
    //     //     showConfirmButton: false,
    //     //     timer: 2000,
    //     //     padding: '2em'
    //     // })
    // });
    Livewire.on('successWithRefresh', (message) => {
        Livewire.dispatch('refreshComponent');
        Livewire.dispatch('success', message);
    });
    Livewire.on('creating', (message) => {
        closeModal()
        Livewire.dispatch('refreshComponent');
        Livewire.dispatch('success', message);
    });
    function closeModal(){
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
        $(".modal-backdrop").remove();
        $('.modal').hide();
    }

})
