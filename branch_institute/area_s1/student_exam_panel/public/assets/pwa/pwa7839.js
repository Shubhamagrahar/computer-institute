document.addEventListener('DOMContentLoaded', () => {
    let deferredPrompt;

    try{

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
    });

    document.querySelector('#pwa_install').addEventListener('click', () => {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                $.ajax({
                    type : 'GET',
                    url : '/pwa/accept',
                })
            } else {
                $.ajax({
                    type : 'GET',
                    url : '/pwa/cancel',
                })
            }
            deferredPrompt = null;
        });
    });

    window.addEventListener('appinstalled', () => {
        $.ajax({
            type : 'GET',
            url : '/pwa/installed',
        });
        sessionStorage.removeItem('__pwa_closed_by_user');
        alert('Hurrah! The app is installed on your device. If the app doesn\'t open automatically, you can manually open it. The app name is Examjila. Enjoy learning!');
    });

    if ('serviceWorker' in navigator) {
        const isInstalled = window.matchMedia('(display-mode: standalone)').matches;
      
        if (!isInstalled && sessionStorage.getItem('__pwa_closed_by_user') != 1) {
         document.querySelector('#pwa_container').style.display = 'block';
        }
      }

     
      document.querySelector('#pwa_close_btn').addEventListener('close.bs.alert', function(){
        sessionStorage.setItem('__pwa_closed_by_user', 1);

      });

    }catch(e){
        console.warn(e); //something or anything
    }

});
