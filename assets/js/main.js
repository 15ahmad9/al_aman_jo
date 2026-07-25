document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');

    if (menuToggle && navLinks) {
        const setMenuState = (isOpen) => {
            navLinks.classList.toggle('active', isOpen);
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            menuToggle.setAttribute('aria-label', isOpen ? 'إغلاق القائمة' : 'فتح القائمة');
            menuToggle.textContent = isOpen ? '✕' : '☰';
        };

        menuToggle.addEventListener('click', function () {
            setMenuState(!navLinks.classList.contains('active'));
        });

        navLinks.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => setMenuState(false));
        });

        document.addEventListener('click', function (event) {
            if (!event.target.closest('.navbar') && navLinks.classList.contains('active')) {
                setMenuState(false);
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) {
                setMenuState(false);
            }
        });
    }

    const slides = document.querySelectorAll('.slide');

    if (slides.length > 1) {
        let currentSlide = 0;

        window.setInterval(function () {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 5000);
    }
});


// Amman Stock Exchange API ticker
async function loadAmmanStock(){
    const track=document.getElementById("stockTrack");
    if(!track) return;

    try{
        // Replace this URL with the official Amman Stock Exchange API endpoint
        const response = await fetch("api/amman-stock.php");
        const data = await response.json();
        const stocks = Array.isArray(data) ? data : (data.result || data.data || []);

        track.innerHTML = stocks.map(stock =>
            `<span class="stock-item">
                ${stock.name}
                <b>${stock.price}</b>
                <span class="${stock.change >= 0 ? 'stock-up':'stock-down'}">
                ${stock.change >= 0 ? '+' : ''}${stock.change}%
                </span>
            </span>`
        ).join("");
    }catch(e){
        track.innerHTML =
        '<span class="stock-item">بورصة عمان - تحديث البيانات غير متوفر حالياً</span>';
    }
}
loadAmmanStock();
setInterval(loadAmmanStock,60000);
