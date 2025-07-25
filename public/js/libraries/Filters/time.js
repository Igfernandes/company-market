export function timeFilter(timeReference, timeCurrent, comparison){
    const dateCurrent = new Date(timeCurrent ?? new Date().getTime())
    const dateRefence = new Date(timeReference)
    
    switch(comparison){
        case ">": 
            return dateCurrent.getTime() >= dateRefence.getTime()
        case "<":
            return dateCurrent.getTime() <= dateRefence.getTime()
        case "==": 
            return dateCurrent.getTime() == dateRefence.getTime()
    }
}