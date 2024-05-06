<?php

namespace app\core;

class Message {

    private $icon;
    private $text;
    private $type;

    public function __toString(): string {
        if ($this->icon && $this->text && $this->type) {
            return $this->render();
        }
    }

    function getText(): ?string {
        if ($this->text) {
            return $this->text;
        }
        return null;
    }

    function getType(): ?string {
        if ($this->type) {
            return $this->type;
        }
        return null;
    }

    function success(string $message): Message {
        $this->icon = "<i class=\"fas fa-check\"></i>";
        $this->type = CONF_MESSAGE_SUCCESS;
        $this->text = $this->filter($message);
        return $this;
    }

    function info(string $message): Message {
        $this->icon = "<i class=\"fas fa-info-circle\"></i>";
        $this->type = CONF_MESSAGE_INFO;
        $this->text = $this->filter($message);
        return $this;
    }

    function danger(string $message): Message {
        $this->icon = "<i class=\"fas fa-times-circle\"></i>";
        $this->type = CONF_MESSAGE_DANGER;
        $this->text = $this->filter($message);
        return $this;
    }

    function warning(string $message): Message {
        $this->icon = "<i class=\"fas fa-exclamation-triangle\"></i>";
        $this->type = CONF_MESSAGE_WARNING;
        $this->text = $this->filter($message);
        return $this;
    }

    function list_danger(string $head, array $message): Message{
        $this->icon = "<i class=\"fas fa-exclamation-triangle\"></i>";
        $this->type = CONF_MESSAGE_DANGER;
        $this->text = $head;
        $this->text .= "<ul>";
        foreach($message as $v){
            $this->text .= "<li>$v</li>";
        }
        $this->text .= "</ul>";
        return $this;
    }

    private function filter(string $message): string {
        return filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    
    public function flash() {
        (session()->set('flash', $this));
    }

    public function render(): ?string {
        if ($this->text) {
            $message = "<br/><div class='text-center " . CONF_MESSAGE_CLASS . "{$this->getType()}' role=\"alert\">
                    <strong>{$this->icon} {$this->getText()}</strong>
                    </div>";
            return $message;
        }
        return null;
    }

}
