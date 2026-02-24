<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Grammars\MySqlGrammar;
use Illuminate\Database\Query\Grammars\MySqlGrammar as QueryGrammar;
use Illuminate\Database\Query\Processors\MySqlProcessor;

class ArrayDatabaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Override the database manager to use our array driver
        $this->app->singleton('db', function ($app) {
            return new class($app['config']['database.default']) {
                private $data = [];
                private $defaultConnection;
                
                public function __construct($defaultConnection)
                {
                    $this->defaultConnection = $defaultConnection;
                }
                
                public function connection($name = null)
                {
                    return new class($this->data) {
                        private $data;
                        
                        public function __construct(&$data)
                        {
                            $this->data = &$data;
                        }
                        
                        public function table($table)
                        {
                            return new class($this->data, $table) {
                                private $data;
                                private $table;
                                
                                public function __construct(&$data, $table)
                                {
                                    $this->data = &$data;
                                    $this->table = $table;
                                    
                                    if (!isset($this->data[$this->table])) {
                                        $this->data[$this->table] = [];
                                    }
                                }
                                
                                public function get()
                                {
                                    return collect($this->data[$this->table] ?? []);
                                }
                                
                                public function insert(array $data)
                                {
                                    $this->data[$this->table][] = $data;
                                    return true;
                                }
                                
                                public function where($column, $operator = null, $value = null)
                                {
                                    return $this;
                                }
                                
                                public function first()
                                {
                                    return $this->data[$this->table][0] ?? null;
                                }
                                
                                public function count()
                                {
                                    return count($this->data[$this->table]);
                                }
                                
                                public function sum($column)
                                {
                                    return array_sum(array_column($this->data[$this->table], $column));
                                }
                            };
                        }
                        
                        public function beginTransaction()
                        {
                            return true;
                        }
                        
                        public function commit()
                        {
                            return true;
                        }
                        
                        public function rollBack()
                        {
                            return true;
                        }
                        
                        public function getSchemaBuilder()
                        {
                            return new class {
                                public function hasTable($table)
                                {
                                    return true; // Assume all tables exist for demo
                                }
                                
                                public function create($table, $callback)
                                {
                                    // No-op for demo
                                }
                            };
                        }
                    };
                }
            };
        });
    }
}
