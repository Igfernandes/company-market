 <div component='exports' class="relative">
     <div class="exports">
         <div component='exports:icon' class="icon bg-disabled text-lg shadow py-2 px-4 rounded cursor-pointer">
             <i class="bi bi-file-earmark-ruled"></i>
         </div>
         <ul component='exports:list'
             class="absolute top-91 right-10 w-[7rem] bg-white text-sm px-2 py-2 border-gray-200 border-2 rounded-sm shadow-md mt-1">
             <li export-entity='<?= $entity ?>'
                 export-type='EXCEL'
                 export-target=''
                 class=" cursor-pointer">
                 <i class="bi bi-filetype-exe"></i>
                 <span><strong>EXCEL</strong></span>
             </li>
             <li export-entity='<?= $entity ?>'
                 export-type='PDF'
                 export-target=''
                 class="mt-2 cursor-pointer">
                 <i class="bi bi-filetype-pdf"></i>
                 <span><strong>PDF</strong></span>
             </li>
         </ul>
     </div>
 </div>