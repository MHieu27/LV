// comment
const commentPost = document.querySelector('.comments-post');
const showComments = document.querySelector('.show-comments');

showComments.addEventListener('click', () => {
    commentPost.classList.toggle('active');
})
//dropdown menu
const settingMenu = document.querySelector('.settings-menu');

function settingsMenuToggle(){
    settingMenu.classList.toggle('settings-menu-height')
}

//follow
const followBtn = document.querySelectorAll('.follow-btn');

followBtn.forEach(btn => {
    btn.addEventListener('click', e => followUnfollow(e.target))
});

function followUnfollow(button) {
    button.classList.toggle('followed')
    if(button.innerText == "Theo dõi") button.innerText = "Bỏ theo dõi";
    else button.innerText = "Theo dõi"
}