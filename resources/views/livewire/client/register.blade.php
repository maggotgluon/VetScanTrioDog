<div class="text-content-dark relative min-h-[50vh]">

    <div class="text-center absolute inset-0 z-50 {{$currentStep>=1? '' : 'hidden'}}" wire:loading>
        <img class="m-auto" src="{{asset('/img/loading.gif')}}"/>
    </div>
    {{-- progress bar --}}
    <div class="flex justify-around relative {{$currentStep>=2? '' : 'hidden'}}">
        <progress value={{$currentStep}} max="5" style="
            position: absolute;
            top: calc(50% - .25rem);
            bottom: calc(50% - .25rem);
            left: auto;
            right: auto;
            height:0.5rem;
            width: calc(100% - 5rem);
            z-index: 0;
        ">
        </progress>
        <x-button.circle  label="1" style="aspect-ratio: 1/1; z-index:1;"  class="rounded-full font-bold 
            {{$currentStep!=1? 'text-secondary-red ring ring-gray-dark bg-white' : 'bg-primary-blue  ring ring-primary-blue hover:text-primary-blue text-white'}} 
            {{$currentStep>=1?'text-primary-blue ring-primary-blue':''}}" />
        <x-button.circle  label="2" style="aspect-ratio: 1/1; z-index:1;"  class="rounded-full font-bold 
            {{$currentStep!=2? 'text-secondary-red ring ring-gray-dark bg-white' : 'bg-primary-blue  ring ring-primary-blue hover:text-primary-blue text-white'}} 
            {{$currentStep>=2?'text-primary-blue ring-primary-blue':''}}" />
        <x-button.circle  label="3" style="aspect-ratio: 1/1; z-index:1;"  class="rounded-full font-bold 
            {{$currentStep!=3? 'text-secondary-red ring ring-gray-dark bg-white' : 'bg-primary-blue  ring ring-primary-blue hover:text-primary-blue text-white'}} 
            {{$currentStep>=3?'text-primary-blue ring-primary-blue':''}}" />
        <x-button.circle  label="4" style="aspect-ratio: 1/1; z-index:1;"  class="rounded-full font-bold 
            {{$currentStep!=4? 'text-secondary-red ring ring-gray-dark bg-white' : 'bg-primary-blue  ring ring-primary-blue hover:text-primary-blue text-white'}} 
            {{$currentStep>=4?'text-primary-blue ring-primary-blue':''}}" disabled="disabled" />
    </div>
    <x-errors title="เกิดข้อผิดพลาด"/>
    {{-- firstpage --}}
    <div class="setup-content min-h-[70vh] flex flex-col transition-all {{ $currentStep != 1 ? 'hidden' : '' }}" id="step-1">
        <!-- <h3> Step 1</h3> -->
        <!-- $status -->
        <div class="text-center mt-8  py-4">
            มาตรวจสุขภาพวันนี้<br>
            กับโปรแกรมตรวจสุขภาพ<br>
            ที่ใช้เลือดปริมาณน้อย<br>
            รู้ผลภายใน 12 นาที<br>
        </div>
        <div class="grid gap-2 pb-8">
            <p>ข้อมูลเจ้าของ</p>
            <x-input wire:model.defer="regClient.firstname" label="ชื่อ" placeholder="ชื่อ" required />
            <x-input wire:model.defer="regClient.lastname" label="นามสกุล" placeholder="นามสกุล" required />
            <x-input wire:model.defer="regClient.phone" maxlength="10" minlength="10"
            label="หมายเลขโทรศัพท์" placeholder="หมายเลขโทรศัพท์" pattern="[0-9]*" inputmode="tel" required/>
            <x-input wire:model.defer="regClient.email" label="อีเมล์" placeholder="อีเมล์" type="email" />

            <div class="flex flex-col justify-center py-2">
                <x-toggle lg wire:model.defer="regClient.consent" wire:click="openConsent" label="ยินยอมและรับทราบนโยบายคุ้มครองข้อมูลส่วนบุคคล" required />
            </div>

            <div class="text-secondary-red text-xs text-center">
                หากลงทะเบียนไม่สำเร็จ <br>
                กรุณาติดต่อ 
                <div class="flex flex-wrap justify-center gap-2 mt-4">
                    <x-button rounded class="m-2 p-2"  green href="https://line.me/ti/p/%40PetsSociety" label="Line : @PetsSociety" />
                    <x-button rounded class="m-2 p-2"  sky href="https://www.facebook.com/PetsSocietybyZoetis" label="facebook.com/PetsSocietybyZoetis" />
                </div>
            </div>
        </div>

        <div class="py-2 text-center mt-auto " wire:loading.remove>
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl {{$regClient['consent']?'':'opacity-50 pointer-events-none'}}" wire:click="firstStepSubmit" type="button" label="ถัดไป" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

    {{-- concent --}}
    <div class="setup-content min-h-[70vh] flex flex-col {{ $currentStep != 1.25 ? 'hidden' : '' }}" id="step-1-25">
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl py-2 font-bold text-primary-blue">
                หนังสือขอความยินยอมสำหรับลูกค้า <br>
                บริษัท โซเอทิส (ประเทศไทย) จำกัด <br>
                (Customer Consent Form)
            </h3>
        </div>
        <div class="max-h-[50vh] overflow-scroll p-4">
            <p class="my-4">    บริษัท โซเอทิส (ประเทศไทย) จำกัด (“<b>บริษัทฯ</b>”) เห็นความสำคัญในการคุ้มครองข้อมูลส่วนบุคคลของท่าน ตามที่กำหนดไว้ในพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 บริษัทฯ จึงได้จัดทำหนังสือขอความยินยอมสำหรับลูกค้าในการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของท่านในฐานะลูกค้า ผู้ใช้สินค้า หรือผู้รับบริการของบริษัท เพื่อขอความยินยอมจากท่านสำหรับวัตถุประสงค์ที่บริษัทฯ ไม่สามารถเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของท่านด้วยฐานทางกฎหมายอื่นได้
            </p><p class="my-4">    ข้าพเจ้าให้ความยินยอมต่อบริษัทฯ ในการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้าเพื่อวัตถุประสงค์ต่อไปนี้
            </p><p class="my-4">    เก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้า เพื่อวัตถุประสงค์ในการทำการตลาดและการติดต่อสื่อสารกับข้าพเจ้า ซึ่งบริษัทฯ ไม่สามารถอ้างอิงฐานทางกฎหมายอื่นได้ เช่น การแจ้งข่าวสารด้านการตลาด การทำการตลาดแบบตอกย้ำความสนใจ (Re-Marketing) โฆษณา สิทธิประโยชน์ การขาย ข้อเสนอพิเศษ การแจ้งเตือน จดหมายข่าว รายงานความคืบหน้า ประกาศ กิจกรรมส่งเสริมการขาย ข่าวสารและข้อมูลที่เกี่ยวกับผลิตภัณฑ์หรือบริการของบริษัท และพันธมิตรทางธุรกิจของบริษัทฯ
            </p><p class="my-4">    เก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลที่ละเอียดอ่อนของข้าพเจ้า เช่น ข้อมูลศาสนา ที่ปรากฎบนสำเนาบัตรประจำตัวประชาชน หรือเอกสารที่ทางราชการออกให้ เพื่อวัตถุประสงค์ในการยืนยันตัวตนและระบุตัวตนของข้าพเจ้า
            </p><p class="my-4">    ข้าพเจ้าขอรับรองและยืนยันว่า ข้าพเจ้าได้อ่านและทราบถึงรายละเอียดของนโยบายความเป็นส่วนตัวของบริษัทฯ ที่ปรากฎ ณ https://www2.zoetis.co.th/privacy-policy ซึ่งอธิบายวิธีการที่บริษัทฯ เก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้า
            </p>
        </div>

        <div class="py-2 text-center mt-auto" wire:loading.remove>
            <x-button lg icon="chevron-left" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl" wire:click="step(1)" type="button" label="กลับ" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

    {{-- confirm otp --}}
    <div class="setup-content min-h-[70vh] flex flex-col {{ $currentStep != 1.5 ? 'hidden' : '' }}" id="step-1-5">
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl pb-2 font-bold"> ยืนยัน OTP </h3>
            <p class="text-center">
                เราได้ส่ง SMS ไปยังหมายเลข {{$regClient['phone']}} 
                @isset($regClient['refno'])
                    <br>Ref. {{$regClient['refno']??''}}
                @endisset
            </p>
        </div>
        <div class="single-input-container flex gap-2 my-8 justify-center">
            <x-input wire:model.defer="regClient.pin" type="text" maxlength="6" inputmode="numeric" />
        </div>
        
        @if ($status == 'error')
        <x-badge icon="exclamation" nagative label="Your OTP is not match, please try agein" />

        <x-button lg outline icon="chevron-left" primary class="py-2 rounded-2xl" wire:click="back(1)" type="button" label="Back" />
        @endif

        <div class="py-2 text-center mt-auto" wire:loading.remove>
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
            wire:click="otpStepSubmit" type="button" label="ถัดไป" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

    {{-- cat dog select --}}
    <div class="setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 1.75 ? 'hidden' : '' }}" id="step-2">
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl pb-2 font-bold text-primary-blue"> กรุณาเลือกชนิดสัตว์ของท่าน </h3>
            
        </div>

        <div class="grid grid-cols-2 gap-2 pb-8 justify-items-center">
            <label class="grid justify-items-center" for="type-1">
                <img src="{{asset('img/dog.png')}}"/>
                <x-radio id="type-1" value="หมา" label="หมา" wire:model.defer="regClient.pet_type" />
            </label>
            
            <label class="grid justify-items-center" for="type-2">
                <img src="{{asset('img/cat.png')}}"/>
                <x-radio id="type-2" value="แมว" label="แมว" wire:model.defer="regClient.pet_type" />
            </label>

        </div>



        <div class="py-2 text-center flex justify-center mt-auto" wire:loading.remove>
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
            wire:click="petSelected" type="button" label="ถัดไป" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

    {{-- cat info --}}
    <div class="setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 2 ? 'hidden' : '' }}" id="step-2-5">
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl pb-2 font-bold text-primary-blue"> กรุณากรอกข้อมูล {{$regClient['pet_type']}} </h3>
            <p class="text-center">
                ที่ต้องการตรวจสุขภาพ<br>
            </p>
        </div>

        <div class="grid gap-2 pb-8">
            <x-input wire:model.defer="regClient.pet_name" label="ชื่อ{{$regClient['pet_type']}}" placeholder="ชื่อ{{$regClient['pet_type']}}" />
            <x-input wire:model.defer="regClient.pet_breed" label="ชื่อสายพันธุ์{{$regClient['pet_type']}}" placeholder="ชื่อสายพันธุ์{{$regClient['pet_type']}}" />

            เลือกช่วงน้ำหนักของ {{$regClient['pet_type']}}
            <div class="grid grid-cols-2 gap-2">
                <span class="my-2">
                    <x-radio id="weigth-1" value="1.25-2.5 กก." label="1.25-2.5 กก." wire:model.defer="regClient.pet_weight" />
                </span>
                <span class="my-2">
                    <x-radio id="weigth-2" value="2.6-5 กก." label="2.6-5 กก." wire:model.defer="regClient.pet_weight" />
                </span>
                <span class="my-2">
                    <x-radio id="weigth-3" value="5.1-10 กก." label="5.1-10 กก." wire:model.defer="regClient.pet_weight" />
                </span>
                {{-- @if ({{$regClient['pet_type']}} == 'หมา') --}}
                    
                    <span class="my-2">
                        <x-radio id="weigth-4" value="10.1-20 กก." label="10.1-20 กก." wire:model.defer="pet_weight" />
                    </span>
                    <span class="my-2">
                        <x-radio id="weigth-5" value="20.1-40 กก." label="20.1-40 กก." wire:model.defer="pet_weight" />
                    </span>
                    <span class="my-2">
                        <x-radio id="weigth-6" value="40.1-60 กก." label="40.1-60 กก." wire:model.defer="pet_weight" />
                    </span>
                {{-- @endif --}}
            </div>

            <div class="grid grid-cols-2 gap-2">
                <x-native-select label="อายุ (ปี)" wire:model.defer="regClient.pet_age_year" placeholder="ระบุปี" :options="['0','1', '2', '3', '4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20']" />
                <x-native-select label="อายุ (เดือน)" wire:model.defer="regClient.pet_age_month" placeholder="ระบุเดือน" :options="['0','1', '2', '3', '4','5','6','7','8','9','10','11']" />
            </div>
        </div>



        <div class="py-2 text-center flex justify-center mt-auto" wire:loading.remove>
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
            wire:click="petStepSubmit" type="button" label="ถัดไป" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>


    {{-- cat more info --}}
    <div class="setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 2.5 ? 'hidden' : '' }}" id="step-2-5">
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl pb-2 font-bold text-primary-blue"> กรุณากรอกข้อมูล{{$regClient['pet_type']}} </h3>
            <p class="text-center">
                ที่ต้องการตรวจสุขภาพ<br>
                {{env('APP_NAME')}}
            </p>
        </div>

        <div class="grid gap-2 pb-8">

            สัตว์เลี้ยงของท่านตรวจสุขภาพครั้งสุดท้ายเมื่อไหร่
            <div class="grid gap-2">
                <span class="my-2">
                    <x-radio id="check-1" value="ไม่เคยตรวจเลย" label="ไม่เคยตรวจเลย" wire:model.defer="regClient.vet_check" />
                </span>
                <span class="my-2">
                    <x-radio id="check-2" value="ภายใน 6 เดือน" label="ภายใน 6 เดือน" wire:model.defer="regClient.vet_check" />
                </span>
                <span class="my-2">
                    <x-radio id="check-3" value="6 - 12 เดือน" label="6 - 12 เดือน" wire:model.defer="regClient.vet_check" />
                </span>
                <span class="my-2">
                    <x-radio id="check-3" value="มากกว่า 1 ปี" label="มากกว่า 1 ปี" wire:model.defer="regClient.vet_check" />
                </span>
            </div>
        </div>

        <x-input wire:model.defer="regClient.ChronicDisease" label="กรุณาระบุโรคประจำตัว (ถ้ามี)" placeholder="หากไม่มีให้เว้นว่างไว้" />

        <div class="py-2 text-center flex justify-center mt-auto" wire:loading.remove>
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
            wire:click="petMoreInfoSubmit" type="button" label="ถัดไป" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

    {{-- vet info --}}
    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 3 ? 'hidden' : '' }} " id="step-3">
        <div class="mt-8 pb-2 text-center ">
            <h3 class="font-bold">
                เลือกคลินิก หรือโรงพยาบาลสัตว์
            </h3>
            <p>ที่ท่านสะดวกเข้าร่วมโปรแกรมตรวจสุขภาพ<br>
                {{-- กรุณาเลือกที่อยู่ของ <u>คลินิกหรือโรงพยาบาลสัตว์ที่ท่านสะดวก</u> --}}
            </p>
        </div>

        
        @if ($vet_list['province']!=null)
        <div class="mt-4" >
            <x-select
                label="จังหวัด" placeholder="เลือกจังหวัด"
                wire:model.live="selected_vet.province"
                :options="$vet_list['province']"
                clearable=false/>
        </div>
        @endif
        @if ($selected_vet['province']!=null)
        <div class="mt-4">
            <x-native-select 
                label="อำเภอ" placeholder="เลือกอำเภอ" 
                wire:model.live="selected_vet.district" 
                :options="$vet_list['city']" /> 
        </div>
        @endif

        @if ($selected_vet['district']!=null)
        <div class="mt-4">
            <x-native-select 
                label="ตำบล" placeholder="เลือกตำบล" 
                wire:model.live="selected_vet.tambon" 
                :options="$vet_list['area']" />
        </div>
        @endif

        @if($regClient['vet_id']==null)
        <div class="mt-4 bg-[#E9EFF6] rounded-xl p-2 h-[25vh] overflow-y-scroll soft-scrollbar">
            @foreach ( $vet_list['name'] as $id => $name )
            <div class="mb-4">
                <x-radio id="{{$id}}" label="{{$id}} {{$name}}" value="{{$id}}" 
                wire:model.lazy="selected_vet.name" />
            </div>
            @endforeach
        </div>
        @else
        <div class="mt-4">
            {{$regClient['vet']->vet_name}}<br>
            <p>
            {{$regClient['vet']->vet_area}}
            {{$regClient['vet']->vet_city}},
            {{$regClient['vet']->vet_province}}</p>
        </div>
        @endif
        


        <div class="py-2 text-center flex justify-center mt-auto" wire:loading.remove>
            <x-button wire:loading.attr="disabled"  lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
            wire:click="vetStepSubmit" type="button" label="ถัดไป" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

</div>
