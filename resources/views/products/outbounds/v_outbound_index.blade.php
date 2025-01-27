@extends('layouts.default')

@section('title', 'ส่งออกด้วยใบจำหน่าย')
@section('content')


    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="">สินค้า > ส่งสินค้าออก</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">
                    <div class="w-full p-5 bg-white rounded-md">
                        <div class=" w-full flex ">

                            {{-- search input --}}
                            <div class="w-3/4 flex gap-2 ">
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหา</p>
                                        <input type="text" placeholder="กรอกรายละเอียดที่ต้องการค้นหา..."
                                            class="input-primary h-[3rem]" name="lot_out_keyword" id="lot_out_keyword">
                                    </div>
                                </div>
                                <div class="md:w-[15rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหาจาก</p>
                                        <select name="lot_out_attribute" id="lot_out_attribute"
                                            class="w-full h-[3rem] input-primary px-2">
                                            <option value="lot_out_number">หมายเลขรายการส่งออก</option>
                                            <option value="lot_out_creater">ผู้ที่สร้าง</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[15rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">สถานะ</p>
                                        <select name="lot_out_status" id="lot_out_status"
                                            class="w-full h-[3rem] input-primary px-2">
                                            <option value="lot_out_intialize">รอดำเนินการ</option>
                                            <option value="lot_out_closed">ปิดล็อต</option>
                                            <option value="lot_out_all_status">ทั้งหมด</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[10rem] h-full  mt-5">
                                    <div class="w-full">
                                        <button
                                            class="w-full h-[3rem] gap-2 btn-primary flex items-center justify-center mx-2"
                                            onclick="lotout_serch()">
                                            <div>
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </div>
                                            <div>
                                                <p>ค้นหา</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- add LotOut inbound --}}
                            <div class="w-full flex justify-end gap-3 mt-3">
                                <div class=" items-center flex h-full relative">
                                    <i class="fa-solid fa-truck lg:text-[2rem] text-sm cursor-pointer lg:mt-4"></i>
                                    <div class="absolute flex top-4 left-[-8px]">
                                        <p
                                            class="w-[1rem] h-[1rem] bg-red-500 rounded-full text-white flex items-center justify-center py-1 mb-1">
                                            1</p>
                                    </div>
                                </div>
                                <div class="mt-3 lg:pt-0">
                                    <a class="btn-secondary px-4 flex items-center h-[3rem] gap-1"
                                        href="{{ url('product/outbounds/view-outbound-latest') }}">
                                        <div>
                                            <div class="flex items-center gap-1">
                                                <i
                                                    class="fa-solid fa-clock-rotate-left cursor-pointer text-[0.8rem] mt-[2px]"></i>
                                                <div>
                                                    <p class=" md:text-sm lg:block hidden text-[0.5]">รายการล่าสุด</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="mt-3 lg:pt-0">
                                    <a class="btn-primary px-4 flex items-center h-[3rem] gap-1"
                                        href="{{ url('product/outbounds/create-outbound-order') }}">
                                        <div>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                                                <div>
                                                    <p class="lg:text-sm lg:block hidden">สร้างรายการส่งออก</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full bg-black/20 mt-2 rounded-md">
                        <div class="py-2 w-full bg-[#D9D9D9] sm:rounded-lg">
                            <b class="mx-2  mt-2 rounded-md text-black text-lg">
                                ตารางรายการสินค้าส่งออกรอจัดการ</b>
                        </div>
                        <div class="relative overflow-x-auto shadow-md ">
                            <table class="w-full text-sm text-left rtl:text-right bg-[#212529] ">
                                <thead class="text-xs text-white uppercase ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ลำดับ
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            หมายเลขรายการส่งออก
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            วันที่สร้าง
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ผู้ที่สร้าง
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            สถานะ
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            การกระทำ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="lot_out_table" id="lot_out_table">
                                    @foreach ($lotouts as $index => $LotOut)
                                        <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                            <td class="px-6 text-center">
                                                {{ $index + 1 }}
                                            </td>

                                            <td class="px-6 text-center">
                                                {{ $LotOut->lot_out_number }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ date('d/m/Y', strtotime($LotOut->created_at)) }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $LotOut->users->fname . ' ' . $LotOut->users->lname }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if ($LotOut->lot_out_status === 'Initialized')
                                                    <div>
                                                        <p
                                                            class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                                            {{ $LotOut->lot_out_status }}</p>
                                                    </div>
                                                @else
                                                    <div>
                                                        <p
                                                            class="border text-center bg-green-700 rounded-3xl py-1 text-white">
                                                            {{ $LotOut }}</p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 flex gap-3 text-gray-500 justify-center">
                                                <a href="{{ url('/product/outbounds/edit-outbound-order' . '/' . $LotOut->lot_out_id) }}"
                                                    class="">
                                                    <i
                                                        class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                                |

                                                <i
                                                    class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-center my-4">
                        {{ $lotouts->links('pagination::custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const lotout_serch = async () => {
            try {
                //ดึงค่า
                const lot_out_search = document.getElementById("lot_out_keyword").value;
                const lot_out_attribute = document.getElementById("lot_out_attribute").value;
                const lot_out_type = document.getElementById("lot_out_status").value;

                //ส่ง req
                const response = await fetch('/product/outbounds/search-lot-out', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        lot_out_search,
                        lot_out_attribute,
                        lot_out_type
                    })
                });

                if (response.status === 200) {
                    console.log(response.data)
                    const responseData = await response.json();
                    const lots = responseData.data;
                    console.log(lots)
                    const lotTableBody = document.getElementById("lot_out_table");
                    lotTableBody.innerHTML = ""; // Clear previous results
                    if (lots?.length === 0) {
                        // Display message when no results are found
                        lotTableBody.innerHTML = `<tr>
                            <td colspan="5">ไม่พบล็อตสินค้า</td>
                            </tr>`;
                    } else {
                        lots?.map((search, index) => {
                            // สร้าง element ของแต่ละ row ในตาราง
                            const row = `
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                    <td class="px-6 py-4 text-center">${index + 1}</td>
                                    <td class="px-6 py-4 text-center">${search.lot_out_number}</td>
                                    <td class="px-6 py-4 text-center" id="dateCell_${index}"></td> <!-- เพิ่ม id ให้กับ cell เพื่อแทนที่วันที่ในภายหลัง -->
                                    <td class="px-6 py-4 text-center">${search.user_id}</td> <!-- อาจจะต้องแก้ไขเป็นรหัสผู้ใช้หรือข้อมูลที่เหมาะสม -->
                                    <td class="px-6 py-4 text-center">
                                        <div>
                                            <p class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                                ${search.lot_out_status}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 flex gap-3 text-gray-500 justify-center">
                                        <a href="{{ url('/product/inbounds/edit-inbound-order') }}/${search.lot_out_id}" class="">
                                            <i class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i>
                                        </a>
                                        |
                                        <i class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i>
                                    </td>
                                </tr>
                            `;
                            // เพิ่ม row ลงในตาราง
                            lot_out_table.innerHTML += row;

                            // สร้างวัตถุ Date จากค่า timestamp ที่ได้รับมา
                            const timestamp = new Date(search.created_at)
                                .getTime(); // แปลงจากประเภท string ให้เป็น Date object และดึง timestamp ออกมา
                            const date = new Date(timestamp);

                            // กำหนดรูปแบบของวันที่และเวลา
                            const formattedDate = ("0" + date.getDate()).slice(-2) + "/" + ("0" + (date
                                .getMonth() + 1)).slice(-2) + "/" + date.getFullYear();

                            // แสดงผลลัพธ์ใน cell ที่มี id เรากำหนดไว้
                            document.getElementById(`dateCell_${index}`).innerText = formattedDate;
                        });
                    }
                } else {
                    throw new Error('Failed to fetch data');
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: "error",
                    title: `เกิดข้อผิดพลาด`,
                });
            }
        }
    </script>
@endsection
