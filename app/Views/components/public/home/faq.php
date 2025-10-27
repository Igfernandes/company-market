<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Collapse\Collapse;

/**
 *  Template base para novos componentes
 *  Component: faq
 *  Caminho: components/public/home/faq
 */

?>

<div component="faq" id="about-us" class="faq relative">
    <div class="overlay absolute bg-black opacity-60 top-0 left-0 w-full h-full"></div>
    <div class="container relative mx-auto">
        <div class="content py-12">
            <div class="flex flex-wrap items-center min-h-[50vh]">
                <div class="w-100 lg:w-47 relative rounded-md mx-4 mb-2 lg:mb-0 lg:mr-5">
                    <div class="overlay absolute top-0 left-0 w-full h-full bg-gray-700 opacity-60"></div>
                    <div class="box text-white p-4 relative z-10">
                        <div class="title text-center md:text-left mb-2">
                            <h3 class="header-sm font-poppins">Já pensou em sua marca online?</h3>
                        </div>
                        <div class="text">
                            <p> O mundo digital oferece infinitas oportunidades para quem deseja crescer e alcançar novos clientes.
                                Criar uma estrutura online é o primeiro passo para tornar sua marca visível, acessível e competitiva.
                                Com um site profissional, redes sociais bem trabalhadas e estratégias de marketing digital, você constrói
                                autoridade, gera confiança e expande seus resultados de forma constante. Comece hoje e veja seu negócio
                                alcançar o próximo nível no ambiente digital!</p>
                        </div>
                    </div>
                </div>
                <div class="w-100  lg:w-47 mx-4 lg:ml-5">
                    <div class="questions bg-white rounded-md py-3 md:py-6 px-1 md:px-4 min-h-[30vh]">
                        <?= Collapse::render(
                            id: "faq",
                            contents: [
                                "Quais são os primeiros passos da empresa?" =>
                                "O primeiro passo é entender profundamente as necessidades do cliente por meio de reuniões estratégicas, 
                                nas quais identificamos desafios e oportunidades. Em seguida, elaboramos propostas detalhadas e fundamentadas, 
                                apresentando as melhores soluções possíveis. Após a escolha da estratégia ideal, iniciamos o cronograma com 
                                total transparência e acompanhamento conjunto até a entrega final.",
                                "A empresa atende em quais regiões?" =>
                                "Atendemos clientes em todo o mundo com suporte em inglês e português, oferecendo soluções digitais e atendimento online. 
                                Para produções presenciais, como eventos, filmagens e fotografias, atuamos em todo o Brasil mediante taxa de locomoção."
                            ],
                            default: "Quais são os primeiros passos da empresa?"
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>