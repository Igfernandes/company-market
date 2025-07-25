import { locations } from "./locations.js"

const stage = {
    show: 'text',
    close: 'password'
}

export function PasswordVisibility(){
    this.handle = (ev) => {
        const { group:groupSelector, input: inputSelector} = locations
        const element = ev.currentTarget

        const group = element.closest(groupSelector)
        const input = group.querySelector(inputSelector)

        const currentStage = element.dataset.passwordVisibility  
        const prevStage = currentStage == 'show' ? 'close' : 'show'
        
        const btnPrev = group.querySelector(`[data-password-visibility='${prevStage}']`)

        if(btnPrev) btnPrev.classList.remove('d-none')

        element.classList.add('d-none')
        input.type = stage[currentStage]
    }
}