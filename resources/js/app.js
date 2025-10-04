import './bootstrap';

// document.addEventListener("DOMContentLoaded", () => {
//     const btn = document.getElementById("userDropdownButton");
//     const menu = document.getElementById("userDropdownMenu");

//     btn.addEventListener("click", () => {
//         menu.classList.toggle("hidden");
//     });

//     // Close dropdown if clicking outside
//     document.addEventListener("click", (event) => {
//         if (!btn.contains(event.target) && !menu.contains(event.target)) {
//             menu.classList.add("hidden");
//         }
//     });
// });



document.addEventListener('DOMContentLoaded', () => {
  // find all dropdown buttons that follow the pattern userDropdown1..N
  const buttons = Array.from(document.querySelectorAll('[id^="userDropdown"]'));
  const menus = buttons
    .map(btn => {
      const idx = btn.id.replace('userDropdown', '');
      return document.getElementById('userMenu' + idx);
    })
    .filter(Boolean);

  // toggle clicked menu, close the rest
  buttons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const idx = btn.id.replace('userDropdown', '');
      const menu = document.getElementById('userMenu' + idx);
      if (!menu) return;
      const wasHidden = menu.classList.contains('hidden');
      // close all menus
      menus.forEach(m => m.classList.add('hidden'));
      // open the clicked one if it was hidden
      if (wasHidden) menu.classList.remove('hidden');
    });
  });

  // prevent clicks inside menu from closing it
  menus.forEach(m => m.addEventListener('click', e => e.stopPropagation()));

  // click outside -> close all
  document.addEventListener('click', () => menus.forEach(m => m.classList.add('hidden')));

  // esc -> close all
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') menus.forEach(m => m.classList.add('hidden'));
  });
});

