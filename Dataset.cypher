
CREATE (CloudAtlas:Production {title:'Nấm kim châm Hàn Quốc', detail:'Nấm kim châm Hàn Quốc được nuôi trồng và đóng gói theo những tiêu chuẩn nghiêm ngặt, bảo đảm các tiêu chuẩn xanh - sạch, chất lượng và an toàn với người dùng. Sợi nấm dai, giòn và ngọt, khi nấu chín rất thơm nên thường được lăn bột chiên giòn, nấu súp hoặc để nướng ăn kèm.'})
CREATE (TheReplacements:Production {title:'Bông cải trắng', detail:'Bông cải trắng được nuôi trồng tại Trung Quốc và đóng gói theo tiêu chuẩn nghiêm ngặt, bảo đảm các tiêu chuẩn xanh - sạch, chất lượng và an toàn với người dùng. Hàm lượng dinh dưỡng cao, vị giòn ngọt nên thường được dùng để chế biến các món xào hoặc luộc, giúp tăng cường miễn dịch.'})
CREATE (Unforgiven:Production {title:'Cà rốt', detail:'Cà rốt là một loại củ rất quen thuộc trong các món ăn của người Việt. Cà rốt có hàm lượng chất dinh dưỡng và vitamin A cao, được xem là nguyên liệu cần thiết cho các món ăn dặm của trẻ nhỏ, giúp trẻ sáng mắt và cung cấp nguồn chất xơ dồi dào.'})
CREATE (TheBirdcage:Production {title:'Cải bẹ xanh', detail:'Cải bẹ xanh được nuôi trồng và đóng gói theo những tiêu chuẩn nghiêm ngặt, bảo đảm các tiêu chuẩn xanh - sach, chất lượng và an toàn với người dùng. Với bẹ lá to, vị hơi đắng nhẹ, mát và thơm nên thường được dùng để nấu canh hoặc rau cuốn ăn kèm với bánh xèo, gỏi cuốn.'})
CREATE (TheDaVinciCode:Production {title:'Sầu riêng', detail:'Sầu Riêng Ri 6 múi sầu riêng cơm khô ráo, dày, vị ngọt, béo vừa phải, khi cầm không bị dính tay và tỷ lệ hạt lép lên tới 40%.'})
CREATE (JerryMaguire:Production {title:'Dua lưới', detail:'Dưa lưới giờ đây đã trở thành loại trái cây được nhiều người tin dùng vì không chỉ ngon mà còn bổ dưỡng.'})

CREATE (StefanArndt:Person {name:"Stefan Arndt", born:1961,email:'StefanArndt@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
CREATE (Howard:Person {name:'Howard Deutch', born:1950,email:'Howard@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
CREATE (ClintE:Person {name:'Clint Eastwood', born:1930,email:'ClintE@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
CREATE (MikeN:Person {name:'Mike Nichols', born:1931,email:'MikeN@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
CREATE (RonH:Person {name:'Ron Howard', born:1954,email:'RonH@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
CREATE (CameronC:Person {name:'Cameron Crowe', born:1957,email:'CameronC@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
CREATE (AngelaScope:Person {name:'Angela Scope',email:'AngelaScope@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
CREATE (JessicaThompson:Person {name:'Jessica Thompson',email:'JessicaThompson@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
CREATE (JamesThompson:Person {name:'James Thompson',email:'JamesThompson@gmail.com',password:'$2y$10$Dw8rknOSP1EUZb7nmXNvIuOoBtoCQbEB3u.8rlIbLYZNVLbq6L3qG'})
CREATE
(JessicaThompson)-[:REVIEWED {summary:'An amazing journey', rating:95}]->(CloudAtlas),
(JessicaThompson)-[:REVIEWED {summary:'Silly, but fun', rating:65}]->(TheReplacements),
(JamesThompson)-[:REVIEWED {summary:'The coolest football movie ever', rating:100}]->(TheReplacements),
(AngelaScope)-[:REVIEWED {summary:'Pretty funny at times', rating:62}]->(TheReplacements),
(JessicaThompson)-[:REVIEWED {summary:'Dark, but compelling', rating:85}]->(Unforgiven),
(JessicaThompson)-[:REVIEWED {summary:"Slapstick redeemed only by the Robin Williams and Gene Hackman's stellar performances", rating:45}]->(TheBirdcage),
(JessicaThompson)-[:REVIEWED {summary:'A solid romp', rating:68}]->(TheDaVinciCode),
(JamesThompson)-[:REVIEWED {summary:'Fun, but a little far fetched', rating:65}]->(TheDaVinciCode),
(JessicaThompson)-[:REVIEWED {summary:'You had me at Jerry', rating:92}]->(JerryMaguire),
(CameronC)-[:PROVIDER{amount:5,price:20000}]->(JerryMaguire),
(RonH)-[:PROVIDER{amount:5,price:20000}]->(TheDaVinciCode),
(MikeN)-[:PROVIDER{amount:5,price:20000}]->(TheBirdcage),
(StefanArndt)-[:PROVIDER{amount:5,price:20000}]->(CloudAtlas),
(ClintE)-[:PROVIDER{amount:5,price:20000}]->(Unforgiven),
(Howard)-[:PROVIDER{amount:5,price:20000}]->(TheReplacements);
