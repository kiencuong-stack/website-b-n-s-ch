<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Thạch Sanh - Phùng Khắc Khoan',
                'author' => 'Phùng Khắc Khoan',
                'isbn' => '978-8934994061',
                'price' => 75000,
                'quantity' => 15,
                'category' => 'Tiểu thuyết',
                'publisher' => 'NXB Văn học',
                'publication_year' => 2020,
                'description' => 'Tác phẩm kinh điển của Phùng Khắc Khoan, kể chuyện về Thạch Sanh - nhân vật anh hùng trong dân tộc Việt.',
            ],
            [
                'title' => 'Truyện Kiều',
                'author' => 'Nguyễn Du',
                'isbn' => '978-8934991234',
                'price' => 85000,
                'quantity' => 20,
                'category' => 'Thi ca - Văn học cổ',
                'publisher' => 'NXB Văn học',
                'publication_year' => 2019,
                'description' => 'Tác phẩm vĩ đại nhất của nền văn học Việt Nam, được các nhà văn coi là kiệt tác.',
            ],
            [
                'title' => 'Tắt Đèn',
                'author' => 'Ngô Tất Tố',
                'isbn' => '978-8934995012',
                'price' => 65000,
                'quantity' => 10,
                'category' => 'Tiểu thuyết',
                'publisher' => 'NXB Văn học',
                'publication_year' => 2018,
                'description' => 'Bức tranh sống động về đời sống nông dân Việt Nam vào đầu thế kỷ XX.',
            ],
            [
                'title' => 'Quỳnh Hoa',
                'author' => 'Vũ Trọng Phụng',
                'isbn' => '978-8934992891',
                'price' => 72000,
                'quantity' => 12,
                'category' => 'Tiểu thuyết',
                'publisher' => 'NXB Văn học',
                'publication_year' => 2017,
                'description' => 'Tiểu thuyết lãng mạn kể chuyện về tình yêu và bi kịch trong gia đình Hà Nội.',
            ],
            [
                'title' => 'Những Đứa Con Nhà Giàu',
                'author' => 'Vũ Trọng Phụng',
                'isbn' => '978-8934993501',
                'price' => 68000,
                'quantity' => 8,
                'category' => 'Tiểu thuyết',
                'publisher' => 'NXB Văn học',
                'publication_year' => 2016,
                'description' => 'Tác phẩm châm biếm xã hội, phơi bày những mặt tối của xã hội Hà Nội những năm 1930.',
            ],
            [
                'title' => 'Dế Mèn Phiêu Lưu Ký',
                'author' => 'Tô Hoài',
                'isbn' => '978-8934994412',
                'price' => 45000,
                'quantity' => 25,
                'category' => 'Truyện thiếu nhi',
                'publisher' => 'NXB Kim Đồng',
                'publication_year' => 2015,
                'description' => 'Tác phẩm nổi tiếng về phiêu lưu của một chú dế tên Mèn, yêu thích của trẻ em Việt Nam.',
            ],
            [
                'title' => 'Chí Phèo',
                'author' => 'Nguyễn Huy Tưởng',
                'isbn' => '978-8934991567',
                'price' => 52000,
                'quantity' => 14,
                'category' => 'Tiểu thuyết ngắn',
                'publisher' => 'NXB Văn học',
                'publication_year' => 2014,
                'description' => 'Truyện ngắn kinh điển mô tả nhân vật lệch lạc Chí Phèo, biểu tượng của người thất lạc xã hội.',
            ],
            [
                'title' => 'Người Đẹp Thuyết - Mai Hương',
                'author' => 'Mai Hương',
                'isbn' => '978-8934992104',
                'price' => 95000,
                'quantity' => 6,
                'category' => 'Tự lợi',
                'publisher' => 'NXB Phụ Nữ',
                'publication_year' => 2021,
                'description' => 'Sách hướng dẫn về cách chăm sóc sắc đẹp và sự tự tin cho phụ nữ hiện đại.',
            ],
        ];

        foreach ($books as $book) {
            $book['image'] = 'placeholders/book.svg';
            Book::create($book);
        }
    }
}
