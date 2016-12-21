<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 21/12/2016
 * Time: 10:00 AM
 */
// Test this using following command
// php -S localhost:8080 ./graphql.php
require_once 'vendor/autoload.php';
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Schema;
use GraphQL\GraphQL;

class Article{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $edad;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param int $edad
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }
}

try {
    $queryType = new ObjectType([
        'name' => 'Query',
        'fields' => [
            'echo' => [
                'type' => Type::string(),
                'args' => [
                    'message' => ['type' => Type::string()],
                ],
                'resolve' => function ($root, $args) {
                    return $root['prefix'].$args['message'];
                }
            ],
            'version' => [
                'type' => Type::string(),
                'resolve' => function(){
                    return 'v2.3';
                }
            ],
        ],
    ]);

    $queryType2 = new ObjectType([
        'name' => 'Query',
        'fields' => [
            'echo' => [
                'type' => Type::listOf(Type::string()),
                'args' => [
                    'id' => ['type' => Type::int()],
                    'nombre' => ['type' => Type::string()],
                ],
                'resolve' => function ($root, $args) {
                    return $root['prefix'].$args['message'];
                }
            ],
        ],
    ]);
    $mutationType = new ObjectType([
        'name' => 'Calc',
        'fields' => [
            'sum' => [
                'type' => Type::int(),
                'args' => [
                    'x' => ['type' => Type::int()],
                    'y' => ['type' => Type::int()],
                ],
                'resolve' => function ($root, $args) {
                    return $args['x'] + $args['y'];
                },
            ],
        ],
    ]);
    $schema = new Schema([
        'query' => $queryType,
        'mutation' => $mutationType,
    ]);
//    $rawInput = file_get_contents('php://input');
    if(!isset($_POST['q'])) throw new InvalidArgumentException("Faltan Parametros", -1);
    $rawInput = $_POST['q'];
    $rootValue = ['prefix' => 'You said: '];
    $result = GraphQL::execute($schema, $rawInput, $rootValue);
} catch (\Exception $e) {
    $result = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);