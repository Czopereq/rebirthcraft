function copyIP() {
    const ip = "og-dcb.pl";
    navigator.clipboard.writeText(ip).then(() => {
        const hint = document.getElementById('copy-hint');
        const originalText = hint.innerText;

        hint.innerText = "✅ SKOPIOWANO DO SCHOWKA!";
        hint.classList.remove('text-warning');
        hint.classList.add('text-success', 'fw-bold');

        setTimeout(() => {
            hint.innerText = originalText;
            hint.classList.add('text-warning');
            hint.classList.remove('text-success', 'fw-bold');
        }, 2000);
    }).catch(err => {
        console.error('Błąd kopiowania:', err);
    });
}

function download(){
    window.open("./resources/ModDownloader.jar");
    }

function send() {
    event.preventDefault;
    var email = document.getElementById('email').value;
    var name = document.getElementById('imie').value;
    var mess = document.getElementById('wiado').value;
    if (email && name && mess) {
        if (email.includes('@')) {
            alert("Dziekujemy za wyslanie wiadomosci");
            document.getElementById('email').value = "";
            document.getElementById('imie').value = "";
            document.getElementById('wiado').value = "";
        } else {
            alert("adres email nie poprawny")
        }

    } else {
        alert("Pola sa puste");
    }
}

document.querySelectorAll('a[href^="#"]').forEach(button => {
    button.addEventListener('click', () => {
        const section = document.getElementById(button.href)

        if (section) {
            section.scrollIntoView({ behavior: 'smooth' })
        }
    });
})