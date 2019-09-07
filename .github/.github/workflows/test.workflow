workflow "New workflow" {
  on = "push"
  resolves = ["maddox/actions"]
}

action "Run deploy script" {
  uses = "maddox/actions/ssh@master"
  args = "/opt/deploy/run"
  secrets = [
    "PRIVATE_KEY",
    "HOST",
    "USER"
  ]
}
