export const event = (el, event, func) => {
    let buttons = document.querySelectorAll(el),
        index, button;

    for (index = 0; index < buttons.length; index++) {
        button = buttons[index];
        button.removeEventListener(event, func);
        button.addEventListener(event, func);
    }
};

export const toggleClass = (el, className) => {
    if (el.classList) {
        el.classList.toggle(className);
    } else {
        let classes = el.className.split(' ');
        let existingIndex = classes.indexOf(className);
        if (existingIndex >= 0)
            classes.splice(existingIndex, 1);
        else
            classes.push(className);
        el.className = classes.join(' ');
    }
};
