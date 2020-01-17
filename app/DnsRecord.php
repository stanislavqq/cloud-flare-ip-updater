<?php


namespace App;


class DnsRecord implements Arrayable
{
    public $id;
    public $type = 'A';
    public $name;
    public $content;
    public $ttl = 1;

    public function __construct(string $id, array $fields = [])
    {
        $this->id = $id;
        $this->name = $fields['name'];
        $this->content = $fields['content'];

        if (isset($fields['type'])) $this->type = $fields['type'];
        if (isset($fields['ttl'])) $this->type = $fields['ttl'];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name'      => $this->name,
            'content'   => $this->content,
            'type'      => $this->type,
            'ttl'       => $this->ttl,
        ];
    }
}