<script>
  $(document).on('click', '.toggle-active', function() {
      let $this = $(this);
      let id = $this.data('id');
      let container = '#dt-table';
      let url = '{{ route('admin.category.toggle_status', ':id') }}';
      url = url.replace(':id', id);
    //   load(container);
      $.ajax({
          url: url,
          method: 'PUT',
          data: {
              _token: @json(csrf_token())
          },
          success: function() {
            //   unLoad(container);
              Snackbar.show({
                  text: '{{ __('success.changed_status') }}',
                  actionTextColor: '#fff',
                  customClass: 'bg-success',
                  actionText: "{{ __('general.common.dismiss') }}"
              });
          }
      })
  })
</script>