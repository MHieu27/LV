    CREATE CONSTRAINT IF NOT EXISTS FOR (p:Person) REQUIRE (p.id) IS UNIQUE;
    CREATE INDEX IF NOT EXISTS FOR (p:Person) ON (p.id);
    CREATE CONSTRAINT IF NOT EXISTS FOR (m:Production) REQUIRE (m.title) IS UNIQUE;
    CREATE INDEX IF NOT EXISTS FOR (m:Production) ON (m.title);
    //CREATE PRODUCT
    CREATE (Namkimcham:Production {title:'Nấm kim châm Hàn Quốc',img:'https://cdn.tgdd.vn/Products/Images/8779/226959/bhx/nam-kim-cham-han-quoc-tui-150g-202202151015334518.jpg',detail:'Nấm kim châm Hàn Quốc được nuôi trồng và đóng gói theo những tiêu chuẩn nghiêm ngặt, bảo đảm các tiêu chuẩn xanh - sạch, chất lượng và an toàn với người dùng. Sợi nấm dai, giòn và ngọt, khi nấu chín rất thơm nên thường được lăn bột chiên giòn, nấu súp hoặc để nướng ăn kèm.'})
    CREATE (Bongcaitrang:Production {title:'Bông cải trắng',img:'https://cdn.tgdd.vn/Products/Images/8785/275320/bhx/bong-cai-trang-tui-500g-600g-1-bong-202303110829571023.jpg', detail:'Bông cải trắng được nuôi trồng tại Trung Quốc và đóng gói theo tiêu chuẩn nghiêm ngặt, bảo đảm các tiêu chuẩn xanh - sạch, chất lượng và an toàn với người dùng. Hàm lượng dinh dưỡng cao, vị giòn ngọt nên thường được dùng để chế biến các món xào hoặc luộc, giúp tăng cường miễn dịch.'})
    CREATE (Carot:Production {title:'Cà rốt',img:'https://cdn.tgdd.vn/Products/Images/8785/303829/bhx/ca-rot-tui-500g-2-5-cu-202303031529108121.jpg', detail:'Cà rốt là một loại củ rất quen thuộc trong các món ăn của người Việt. Cà rốt có hàm lượng chất dinh dưỡng và vitamin A cao, được xem là nguyên liệu cần thiết cho các món ăn dặm của trẻ nhỏ, giúp trẻ sáng mắt và cung cấp nguồn chất xơ dồi dào.'})
    CREATE (Caibexanh:Production {title:'Cải bẹ xanh',img:'https://cdn.tgdd.vn/Products/Images/8820/223329/bhx/cai-be-xanh-baby-goi-300g-202211291952334731.jpg', detail:'Cải bẹ xanh được nuôi trồng và đóng gói theo những tiêu chuẩn nghiêm ngặt, bảo đảm các tiêu chuẩn xanh - sach, chất lượng và an toàn với người dùng. Với bẹ lá to, vị hơi đắng nhẹ, mát và thơm nên thường được dùng để nấu canh hoặc rau cuốn ăn kèm với bánh xèo, gỏi cuốn.'})
    CREATE (Xaurieng:Production {title:'Sầu riêng Ri 6',img:'https://cdn.tgdd.vn/Products/Images/8788/304170/bhx/sau-rieng-ri-6-trai-3kg-35kg-202303131512102272.jpg', detail:'Sầu Riêng Ri 6 múi sầu riêng cơm khô ráo, dày, vị ngọt, béo vừa phải, khi cầm không bị dính tay và tỷ lệ hạt lép lên tới 40%.'})
    CREATE (Dualuoi:Production {title:'Dua lưới',img:'https://cdn.tgdd.vn/Products/Images/8788/273734/bhx/dua-luoi-tron-ruot-cam-trai-tu-12kg-tro-len-202303141156396372.jpg', detail:'Dưa lưới giờ đây đã trở thành loại trái cây được nhiều người tin dùng vì không chỉ ngon mà còn bổ dưỡng.'})
    CREATE (Bapcaithao:Production {title:'Bắp cải thảo',img:'https://cdn.tgdd.vn/Products/Images/8820/275312/bhx/bap-cai-thao-tui-500g-600g-202211281613474712.jpg', detail:'Bắp cải thảo là loại rau có bẹ lá to, giòn, ngọt thường được dùng để nấu canh, xào chung với rau củ hoặc để muối kim chi. Bắp cải thảo của Bách hóa Xanh được trồng tại Lâm Đồng và đóng gói theo những tiêu chuẩn nghiêm ngặt, bảo đảm các tiêu chuẩn xanh - sạch, chất lượng và an toàn với người dùng..'})
    CREATE (Bingoixanh:Production {title:'Bí ngòi xanh',img:'https://cdn.tgdd.vn/Products/Images/8785/271467/bhx/bi-ngoi-xanh-500g-1-2-trai-202303170941025338.jpg', detail:'Bí ngòi xanh được trồng Lâm Đồng có thể dùng để chế biến thành nhiều món ăn ngon cho gia đình như: nấu canh, xào, kho,... Đặc biệt, các thành phần dinh dưỡng có chứa trong loại bí này cũng đem đến rất nhiều tác dụng tích cực đối với sức khỏe con người như: chống lão hoá, giảm cân rất hiệu quả.'})
    CREATE (Camxanh:Production {title:'Cam sành',img:'https://cdn.tgdd.vn/Products/Images/8788/302675/bhx/cam-sanh-vat-nuoc-tui-3kg-18-24-trai-202302151633475672.jpg', detail:'Cam sành là trái cây rất thông dụng trong đời sống, được ưu tiên chọn mua bởi tác dụng thần kỳ của nó mang lại cho sức khỏe chúng ta. Đặc điểm vỏ cam sành màu xanh đến xanh vàng khi chín, sần và dày, tép màu vàng cam đậm, nhiều nước, vị ngọt chua mùi rất thơm và khá nhiều hạt. Phù hợp để vắt nước.'})
    CREATE (Xoaidailoan:Production {title:'Xoài Đài Loan',img:'https://cdn.tgdd.vn/Products/Images/8788/301595/bhx/xoai-dai-loan-trai-tu-600g-202301090853304615.jpg', detail:'Nguồn gốc nhập khẩu, chất lượng, uy tín. Xoài Đài Loan bán tại Bách Hóa XANH có ngoại hình đẹp, bóng bẩy, thịt quả chứa nhiều vitamin. Xoài Đài Loan ngon khi chín màu hồng đỏ, mềm nhưng không nhũn. Cam kết đúng khối lượng và chất lượng, bao bì kín đáo hợp vệ sinh.'})
    CREATE (Xoaihoaloc:Production {title:'Xoài cát Hoà Lộc',img:'https://cdn.tgdd.vn/Products/Images/8788/270312/bhx/xoai-cat-hoa-loc-tui-1kg-1-3-trai-202212231638557864.jpg', detail:'Xoài cát Hoà Lộc là loại trái cây giàu chất xơ, vitamin, khoáng chất. Xoài mua về nên để ăn chín sẽ có vị ngọt đậm đà, xoài cũng mang lại nhiều lợi ích tuyệt vời cho hệ tiêu hóa, tim mạch, giúp mắt sáng, làm đẹp da. Xoài cát Hòa Lộc có vị ngọt thanh dễ chịu, thịt dày, ít xơ.'})
    CREATE (Xoaicatchu:Production {title:'Xoài cát chu',img:'https://cdn.tgdd.vn/Products/Images/8788/270311/bhx/xoai-cat-chu-hop-1kg-2-3-trai-giao-ngau-nhien-song-hoac-chin-202211041108178126.jpg', detail:'Xoài cát chu với hương thơm nồng nàn quyến rũ, là trái cây có vị ngọt đậm đà hấp dẫn khó chối từ. Xoài cát chu ngọt nhất khi chín vàng, ấn nhẹ tay mềm nhưng chắc. Xoài chứa vitamin dồi dào cung cấp năng lượng, tăng cường đề kháng cho cơ thể khỏe mạnh.'})
    CREATE (Buoidaxanh:Production {title:'Bưởi da xanh',img:'https://cdn.tgdd.vn/Products/Images/8788/271694/bhx/buoi-da-xanh-trai-tu-17kg-tro-len-202211160930051354.jpg', detail:'Bưởi Da xanh là trái cây đặc sản nổi tiếng của Việt Nam. Bưởi da xanh có đặc điểm vỏ có màu xanh đến xanh hơi vàng khi chín.Tép bưởi màu hồng đỏ, vị ngọt thanh, màu sắc đẹp mắt, là một trong những loại trái cây cực tốt cho sức khoẻ với nhiều công dụng thần kỳ khác nhau đã được khoa học chứng minh.'})
    CREATE (Duahaudo:Production {title:'Dưa hấu đỏ',img:'https://cdn.tgdd.vn/Products/Images/8788/270325/bhx/dua-hau-do-trai-tu-18kg-tro-len-202211071104486894.jpg', detail:'Dưa hấu đỏ là trái cây nhiều nước và các vitamin, khoáng chất cần thiết, đặc biệt là ít calo và chất béo. Dưa hấu được xem là một sản phẩm thay thế cho nước uống thông thường. Dưa hấu ngọt khi có vỏ xanh đậm, cuống héo, đuôi quả có vùng vàng.'})
    CREATE (Duahaukhonghat:Production {title:'Dưa hấu không hạt',img:'https://cdn.tgdd.vn/Products/Images/8788/272179/bhx/dua-hau-khong-hat-trai-tu-28kg-tro-len-202212071510232043.jpg', detail:'Dưa hấu không hạt là trái cây nhiều nước và các vitamin, khoáng chất cần thiết, đặc biệt là ít calo và chất béo. Dưa hấu được xem là một sản phẩm thay thế cho nước uống thông thường. Dưa ngọt khi trái tròn đều, cuống héo, xanh đậm có đầu vàng.'})
    CREATE (Bapcaitrang:Production {title:'Bắp cải trắng',img:'https://cdn.tgdd.vn/Products/Images/8785/275316/bhx/bap-cai-trang-tui-500gr-1-bap-202205201654550785.jpg', detail:'Bắp cải trắng là loại rau được trồng tại Lâm Đồng rất dễ mua và chế biến thành nhiều món ăn đa dạng khác nhau trong bữa cơm hằng ngày. Bắp cải trắng đặc biệt mang đến lợi ích trong việc hỗ trợ phòng chống ung thư, giúp cơ thể khỏe mạnh toàn diện.'})
    CREATE (Xalachbupmo:Production {title:'Xà lách búp mỡ',img:'https://cdn.tgdd.vn/Products/Images/8820/271482/bhx/xa-lach-bup-mo-goi-500g-202205181605016122.jpg', detail:'Rau xà lách búp mỡ của Bách hóa Xanh được nuôi trồng tại Lâm Đồng và đóng gói theo những tiêu chuẩn nghiêm ngặt, bảo đảm các tiêu chuẩn xanh - sach, chất lượng và an toàn với người dùng. Xà lách mỡ giòn, thơm, tươi mát nên rất thích hợp làm rau ăn kèm cho các món cuốn.'})
    CREATE (Raumongtoi:Production {title:'Rau mồng tơi',img:'https://cdn.tgdd.vn/Products/Images/8820/267915/bhx/rau-mong-toi-4kfarm-goi-500g-202210031636321992.jpg', detail:'Rau an toàn 4KFarm với tiêu chí 4 KHÔNG, luôn ưu tiên bảo vệ sức khỏe người tiêu dùng. Tính hàn đặc trưng của Rau Mùng Tơi 4KFarm khiến nhiều gia đình ưa chuộng để chế biến các món ăn thanh mát, phù hợp với những ngày hè nóng bức. Hàm lượng dinh dưỡng cao cũng là một trong các đặc điểm nổi bật.'})
    CREATE (Caingot:Production {title:'Cải ngọt ',img:'https://cdn.tgdd.vn/Products/Images/8820/223330/bhx/cai-ngot-baby-goi-300g-202205181631113408.jpg', detail:'Rau an toàn 4KFarm với tiêu chí 4 KHÔNG, luôn ưu tiên bảo vệ sức khỏe người tiêu dùng. Hàm lượng chất xơ cao, chứa nhiều chất dinh dưỡng,Cải Ngọt 4KFarm là một trong những loại rau được ưa thích để chế biến những món canh rau ngon bổ dưỡng phù hợp với mọi lứa tuổi.'})

    //CREATE USER
    CREATE (Keanu:Person {name:'Keanu Reeves', born:1964,email:'Keanu@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (Carrie:Person {name:'Carrie-Anne Moss', born:1967,email:'Carrie@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (Laurence:Person {name:'Laurence Fishburne', born:1961,email:'Laurence@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (Hugo:Person {name:'Hugo Weaving', born:1960,email:'Hugo@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (LillyW:Person {name:'Lilly Wachowski', born:1967,email:'LillyW@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (LanaW:Person {name:'Lana Wachowski', born:1965,email:'LanaW@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (JoelS:Person {name:'Joel Silver', born:1952,email:'JoelS@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (StefanArndt:Person {name:"Stefan Arndt", born:1961,email:'StefanArndt@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (Howard:Person {name:'Howard Deutch', born:1950,email:'Howard@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (ClintE:Person {name:'Clint Eastwood', born:1930,email:'ClintE@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (MikeN:Person {name:'Mike Nichols', born:1931,email:'MikeN@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (RonH:Person {name:'Ron Howard', born:1954,email:'RonH@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (CameronC:Person {name:'Cameron Crowe', born:1957,email:'CameronC@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (AngelaScope:Person {name:'Angela Scope',email:'AngelaScope@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (JessicaThompson:Person {name:'Jessica Thompson',email:'JessicaThompson@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
    CREATE (JamesThompson:Person {name:'James Thompson',email:'JamesThompson@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})

    //CREATE RELATION
    CREATE
    //RELATION PROVIDER
    (LillyW)-[:PROVIDER{amount:100,price:68000}]->(Buoidaxanh),
    (LillyW)-[:PROVIDER{amount:100,price:41000}]->(Duahaudo),
    (LillyW)-[:PROVIDER{amount:100,price:65000}]->(Duahaukhonghat),
    (Hugo)-[:PROVIDER{amount:100,price:60000}]->(Xoaicatchu),
    (Hugo)-[:PROVIDER{amount:100,price:90000}]->(Xoaihoaloc),
    (Hugo)-[:PROVIDER{amount:100,price:13000}]->(Xoaidailoan),
    (Keanu)-[:PROVIDER{amount:100,price:7000}]->(Bapcaithao),
    (Keanu)-[:PROVIDER{amount:100,price:6000}]->(Bapcaitrang),
    (Keanu)-[:PROVIDER{amount:100,price:6000}]->(Xalachbupmo),
    (Keanu)-[:PROVIDER{amount:100,price:10000}]->(Raumongtoi),
    (Keanu)-[:PROVIDER{amount:100,price:10000}]->(Caingot),
    (Carrie)-[:PROVIDER{amount:100,price:18000}]->(Bingoixanh),
    (Laurence)-[:PROVIDER{amount:100,price:39000}]->(Camxanh),
    (CameronC)-[:PROVIDER{amount:100,price:54000}]->(Dualuoi),
    (RonH)-[:PROVIDER{amount:100,price:132000}]->(Xaurieng),
    (MikeN)-[:PROVIDER{amount:100,price:20000}]->(Caibexanh),
    (StefanArndt)-[:PROVIDER{amount:100,price:14000}]->(Namkimcham),
    (ClintE)-[:PROVIDER{amount:100,price:8000}]->(Carot),
    (Howard)-[:PROVIDER{amount:100,price:25000}]->(Bongcaitrang),
    //RELATION PURCHASE
    //Buoidaxanh-------------------------------------------------------------------------------
    (ClintE)-[:PURCHASE {amount: 20, price: 68000}]->(Buoidaxanh),
    (ClintE)-[:REVIEWED {rating: 5, summary: 'Sản phẩm tươi ngon'}]->(Buoidaxanh),

    (LanaW)-[:PURCHASE {amount: 20, price: 68000}]->(Buoidaxanh),
    (LanaW)-[:REVIEWED {rating: 5, summary: 'Sản phẩm tươi ngon'}]->(Buoidaxanh),

    (AngelaScope)-[:PURCHASE {amount:10, price:68000}]->(Buoidaxanh),
    (AngelaScope)-[:REVIEWED {rating: 5, summary: 'Sản phảm tươi ngon'}]->(Buoidaxanh),

    (Keanu)-[:PURCHASE {amount:20, price:68000}]->(Buoidaxanh),
    (Keanu)-[:REVIEWED {rating: 2, summary: 'Sản phảm không tươi ngon'}]->(Buoidaxanh),

    (JessicaThompson)-[:PURCHASE {amount:10, price:68000}]->(Buoidaxanh),
    (JessicaThompson)-[:REVIEWED {rating: 0, summary: 'Sản phảm không tươi ngon'}]->(Buoidaxanh),

    (JamesThompson)-[:PURCHASE {amount:10, price:68000}]->(Buoidaxanh),
    (JamesThompson)-[:REVIEWED {rating: 1, summary: 'Sản phảm không tươi ngon'}]->(Buoidaxanh),

    (RonH)-[:PURCHASE {amount:10, price:68000}]->(Buoidaxanh),
    (RonH)-[:REVIEWED {rating: '', summary: ''}]->(Buoidaxanh),

    (CameronC)-[:PURCHASE {amount:20, price:68000}]->(Buoidaxanh),
    (CameronC)-[:REVIEWED {rating: '', summary: ''}]->(Buoidaxanh),
    //Carot-------------------------------------------------------------------------------
    (ClintE)-[:PURCHASE {amount: 20, price: 68000}]->(Carot),
    (ClintE)-[:REVIEWED {rating: '', summary: ''}]->(Carot),

    (LanaW)-[:PURCHASE {amount: 20, price: 41000}]->(Carot),
    (LanaW)-[:REVIEWED {rating: 4, summary: 'Sản phẩm tươi ngon'}]->(Carot),

    (AngelaScope)-[:PURCHASE {amount:10, price:41000}]->(Carot),
    (AngelaScope)-[:REVIEWED {rating: '', summary: ''}]->(Carot),

    (Keanu)-[:PURCHASE {amount:20, price:41000}]->(Carot),
    (Keanu)-[:REVIEWED {rating: '', summary: ''}]->(Carot),

    (JessicaThompson)-[:PURCHASE {amount:10, price:41000}]->(Carot),
    (JessicaThompson)-[:REVIEWED {rating: 0, summary: 'Sản phảm không tươi ngon'}]->(Carot),

    (JamesThompson)-[:PURCHASE {amount:10, price:41000}]->(Carot),
    (JamesThompson)-[:REVIEWED {rating: '', summary: ''}]->(Carot),

    (RonH)-[:PURCHASE {amount:10, price:41000}]->(Carot),
    (RonH)-[:REVIEWED {rating: 2, summary: 'Sản phảm không tươi ngon'}]->(Carot),

    (CameronC)-[:PURCHASE {amount:20, price:41000}]->(Carot),
    (CameronC)-[:REVIEWED {rating: '', summary: ''}]->(Carot),

    //Duahaukhonghat-------------------------------------------------------------------------------
    (ClintE)-[:PURCHASE {amount: 20, price: 68000}]->(Duahaukhonghat),
    (ClintE)-[:REVIEWED {rating: '', summary: ''}]->(Duahaukhonghat),

    (LanaW)-[:PURCHASE {amount: 20, price: 65000}]->(Duahaukhonghat),
    (LanaW)-[:REVIEWED {rating: '', summary: ''}]->(Duahaukhonghat),

    (AngelaScope)-[:PURCHASE {amount:10, price:65000}]->(Duahaukhonghat),
    (AngelaScope)-[:REVIEWED {rating: 4, summary: 'Sản phảm tươi ngon'}]->(Duahaukhonghat),

    (Keanu)-[:PURCHASE {amount:20, price:65000}]->(Duahaukhonghat),
    (Keanu)-[:REVIEWED {rating: 1, summary: 'Sản phảm tươi ngon'}]->(Duahaukhonghat),

    (JessicaThompson)-[:PURCHASE {amount:10, price:65000}]->(Duahaukhonghat),
    (JessicaThompson)-[:REVIEWED {rating: '', summary: ''}]->(Duahaukhonghat),

    (JamesThompson)-[:PURCHASE {amount:10, price:65000}]->(Duahaukhonghat),
    (JamesThompson)-[:REVIEWED {rating: '', summary: ''}]->(Duahaukhonghat),

    (RonH)-[:PURCHASE {amount:10, price:65000}]->(Duahaukhonghat),
    (RonH)-[:REVIEWED {rating: 1, summary: 'Sản phảm không tươi ngon'}]->(Duahaukhonghat),

    (CameronC)-[:PURCHASE {amount:20, price:65000}]->(Duahaukhonghat),
    (CameronC)-[:REVIEWED {rating: 1, summary: 'Sản phảm không tươi ngon'}]->(Duahaukhonghat),

    //Xoaicatchu-------------------------------------------------------------------------------
    (ClintE)-[:PURCHASE {amount: 20, price: 68000}]->(Xoaicatchu),
    (ClintE)-[:REVIEWED {rating: '', summary: ''}]->(Xoaicatchu),

    (LanaW)-[:PURCHASE {amount: 20, price: 60000}]->(Xoaicatchu),
    (LanaW)-[:REVIEWED {rating: 2, summary: 'Sản phẩm không tươi ngon'}]->(Xoaicatchu),

    (AngelaScope)-[:PURCHASE {amount:10, price:60000}]->(Xoaicatchu),
    (AngelaScope)-[:REVIEWED {rating: 2, summary: 'Sản phẩm không tươi ngon'}]->(Xoaicatchu),

    (Keanu)-[:PURCHASE {amount:20, price:60000}]->(Xoaicatchu),
    (Keanu)-[:REVIEWED {rating: 3, summary: 'Sản phẩm không tươi ngon'}]->(Xoaicatchu),

    (JessicaThompson)-[:PURCHASE {amount:10, price:60000}]->(Xoaicatchu),
    (JessicaThompson)-[:REVIEWED {rating: 4, summary: 'Sản phảm tươi ngon'}]->(Xoaicatchu),

    (JamesThompson)-[:PURCHASE {amount:10, price:60000}]->(Xoaicatchu),
    (JamesThompson)-[:REVIEWED {rating: 4, summary: 'Sản phẩm tươi ngon'}]->(Xoaicatchu),

    (RonH)-[:PURCHASE {amount:10, price:60000}]->(Xoaicatchu),
    (RonH)-[:REVIEWED {rating: '', summary: ''}]->(Xoaicatchu),

    (CameronC)-[:PURCHASE {amount:20, price:60000}]->(Xoaicatchu),
    (CameronC)-[:REVIEWED {rating: 4, summary: 'Sản phẩm tươi ngon'}]->(Xoaicatchu),

    //Bongcaitrang-------------------------------------------------------------------------------
    (ClintE)-[:PURCHASE {amount: 20, price: 68000}]->(Bongcaitrang),
    (ClintE)-[:REVIEWED {rating: '', summary: ''}]->(Bongcaitrang),

    (LanaW)-[:PURCHASE {amount: 20, price: 90000}]->(Bongcaitrang),
    (LanaW)-[:REVIEWED {rating: 2, summary: 'Sản phẩm không tươi ngon'}]->(Bongcaitrang),

    (AngelaScope)-[:PURCHASE {amount:10, price:90000}]->(Bongcaitrang),
    (AngelaScope)-[:REVIEWED {rating: 0, summary: 'Sản phẩm không tươi ngon'}]->(Bongcaitrang),

    (Keanu)-[:PURCHASE {amount:20, price:90000}]->(Bongcaitrang),
    (Keanu)-[:REVIEWED {rating: 4, summary: 'Sản phẩm tươi ngon'}]->(Bongcaitrang),

    (JessicaThompson)-[:PURCHASE {amount:10, price:90000}]->(Bongcaitrang),
    (JessicaThompson)-[:REVIEWED {rating: '', summary: ''}]->(Bongcaitrang),

    (JamesThompson)-[:PURCHASE {amount:10, price:90000}]->(Bongcaitrang),
    (JamesThompson)-[:REVIEWED {rating: '', summary: ''}]->(Bongcaitrang),

    (RonH)-[:PURCHASE {amount:10, price:90000}]->(Bongcaitrang),
    (RonH)-[:REVIEWED {rating: '', summary: ''}]->(Bongcaitrang),

    (CameronC)-[:PURCHASE {amount:20, price:90000}]->(Bongcaitrang),
    (CameronC)-[:REVIEWED {rating: 5, summary: 'Sản phẩm tươi ngon'}]->(Bongcaitrang)
//MATCH (p:Person)
//MATCH (prod:Production)
//WHERE NOT (p)-[:REVIEWED]->(prod)
//CREATE (p)-[:REVIEWED]->(prod)
