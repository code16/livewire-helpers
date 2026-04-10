
<script @if($nonce = Vite::cspNonce()) nonce="{{ $nonce }}" @endif>
    document.addEventListener('livewire:init', () => {
        Livewire.interceptRequest(({ onError }) => {
            onError(({ response, preventDefault }) => {
                @if(!config('app.debug'))
                    preventDefault();
                    if (response.status === 500) {
                        window.alert({{ \Illuminate\Support\Js::from(__('livewire-helpers::errors.500')) }});
                    }
                @endif
                if (response.status === 419) {
                    preventDefault();
                    window.alert({{ \Illuminate\Support\Js::from(__('livewire-helpers::errors.419')) }});
                    location.reload();
                }
            })
        });
    });
</script>
